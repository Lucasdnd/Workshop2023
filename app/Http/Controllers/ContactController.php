<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'nullable',
        'email' => 'required|email|unique:contacts,email',
        'phone' => 'nullable',
        'address' => 'nullable',
        'city' => 'nullable',
        'state' => 'nullable',
        'zip_code' => 'nullable',
        'country' => 'nullable',
        'company_id' => 'nullable|exists:companies,id',
        'status' => 'required|in:lead,dead_lead,prospect,dead_prospect,client',
        'type' => 'required|in:B2B,B2C',
    ]);

    $contact = new Contact();
    $contact->fill($request->all());
    $contact->save();

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
            $redirectRoute = 'create';
            break;
    }

    return redirect()->intended(route('contact.'.$redirectRoute))->with('success', 'Contact created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function leads()
    {
        $contacts = Contact::where('status', 'lead')->get();
        return view('contact.leads', compact('contacts'));
    }

    public function prospects()
    {
        $contacts = Contact::where('status', 'prospect')->get();
        return view('contact.prospects', compact('contacts'));
    }

    public function clients()
    {
        $contacts = Contact::where('status', 'client')->get();
        return view('contact.clients', compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
{
    $validatedData = $request->validate([
        'first_name' => 'required',
        'last_name' => 'nullable',
        'email' => 'required|email|unique:contacts,email,' . $contact->id,
        'phone' => 'nullable',
        'address' => 'nullable',
        'city' => 'nullable',
        'state' => 'nullable',
        'zip_code' => 'nullable',
        'country' => 'nullable',
        'company_id' => 'nullable|exists:companies,id',
        'status' => 'required|in:lead,prospect,client,dead_lead,dead_prospect',
        'type' => 'required|in:B2B,B2C',
    ]);

    $contact->update($validatedData);
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
        case 'client':
            $redirectRoute = 'clients';
            break;
        case 'dead_prospect':
            $redirectRoute = 'prospects';
            break;
        case 'dead_client':
            $redirectRoute = 'clients';
            break;
        default:
            $redirectRoute = '';
            break;
    }


    return redirect()->intended(route('contact.'.$redirectRoute))->with('success', 'Contact updated successfully.');
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

        return redirect()->route('contact.'.$redirectRoute)->with('success', 'Contact deleted successfully.');
    }
}
