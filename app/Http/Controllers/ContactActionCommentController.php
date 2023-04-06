<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ContactActionComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactActionCommentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Action $action)
    {
        return view('comments.create', ['action' => $action]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Action $action)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        if (Auth::check()) {
            $comment = new ContactActionComment([
                'comment' => $request->input('comment'),
            ]);

            // Associate the contact and action
            $comment->contact()->associate($action->contact);
            $comment->action()->associate($action);

            // Associate the comment with the authenticated user
            $comment->user()->associate(Auth::user());

            $comment->save();

            return redirect()->route('actions.show', $action->id)->with('success', 'Un commentaire à été ajouté !');
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to post a comment.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Action $action, ContactActionComment $comment)
    {
        if (!$comment->canBeEditedOrDeletedByUser(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', ['action' => $action, 'comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Action $action, ContactActionComment $comment)
    {
        if (!$comment->canBeEditedOrDeletedByUser(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'comment' => 'required',
        ]);

        $comment->update([
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('actions.show', $action->id)->with('success', 'Le commentaire a été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Action $action, ContactActionComment $comment)
    {
        if (!$comment->canBeEditedOrDeletedByUser(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('actions.show', $action->id)->with('success', 'Le commentaire a été supprimé!');
    }
}
