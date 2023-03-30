<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('contacts.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:contacts',
    //         'phone' => 'nullable',
    //         'status' => 'required|in:lead,dead_lead,prospect,dead_prospect,customer',
    //         'type' => 'required|in:B2B,B2C',
    //     ]);
    //     $contact = new Contact($request->all());
    //     $contact->save();

    //     return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    // }

    /**
     * Display the specified resource.
     */
    public function leads()
    {
        $contacts = Contact::where('status', 'lead')->get();
        return view('leads', compact('contacts'));
    }

    public function prospects()
    {
        $contacts = Contact::where('status', 'prospect')->get();
        return view('prospects', compact('contacts'));
    }

    public function clients()
    {
        $contacts = Contact::where('status', 'client')->get();
        return view('clients', compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable',
            'status' => 'required|in:lead,dead_lead,prospect,dead_prospect,customer',
            'type' => 'required|in:B2B,B2C',
        ]);
        $contact->update($request->all());
        $status = $contact->status;

        switch ($status) {
            case 'lead':
                $redirectRoute = 'leads';
                break;
            case 'prospect':
                $redirectRoute = 'prospects';
                break;
            case 'client':
                $redirectRoute = 'clients';
                break;
            default:
                $redirectRoute = '';
                break;
        }

        return redirect()->route($redirectRoute)->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $status = $contact->status;
        $contact->delete();

        switch ($status) {
            case 'lead':
                $redirectRoute = 'leads';
                break;
            case 'prospect':
                $redirectRoute = 'prospects';
                break;
            case 'client':
                $redirectRoute = 'clients';
                break;
            default:
                $redirectRoute = '';
                break;
        }

        return redirect()->route($redirectRoute)->with('success', 'Contact deleted successfully.');
    }
}
