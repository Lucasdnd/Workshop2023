<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Contact;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actions = Action::with('contact')
            ->orderByRaw("
            CASE
                WHEN scheduled_at > date('now') THEN 0
                ELSE 1
            END ASC,
            CASE
                WHEN scheduled_at < date('now') THEN scheduled_at
                ELSE date('now') - scheduled_at
            END DESC
        ")
            ->get();
        return view('actions.index', compact('actions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contacts = Contact::all();
        return view('actions.create', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:call,email,meeting,note,other',
            'comment' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
            'contact_id' => 'required|exists:contacts,id',
        ]);

        $action = Action::create($validatedData);

        return redirect()->route('actions.show', $action);
    }

    /**
     * Display the specified resource.
     */
    public function show(Action $action)
    {
        return view('actions.show', compact('action'));
    }

    /**
     * Mark an action as done
     */
    public function markAsDone(Action $action)
    {
        $action->update(['is_done' => !$action->is_done]);

        $message = $action->is_done ? 'L\'action a été marquée comme réalisée.' : 'L\'action a été marquée comme non réalisée.';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Action $action)
    {
        $contacts = Contact::all();
        return view('actions.edit', compact('action', 'contacts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Action $action)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:call,email,meeting,note,other',
            'comment' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
            'contact_id' => 'required|exists:contacts,id',
        ]);

        $action->update($validatedData);

        return redirect()->route('actions.show', $action);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $action = Action::findOrFail($id);
        $action->delete();

        if ($request->input('source') === 'contact') {
            if ($action) {
                return redirect()->route('contact.show', $action->contact_id)->with('success', 'Action supprimée avec succès.');
            } else {
                return redirect()->route('contacts.index')->with('error', 'Impossible de trouver l\'action à supprimer.');
            }
        } else {
            return redirect()->route('actions.index')->with('success', 'Action supprimée avec succès.');
        }
    }
}
