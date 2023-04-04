<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('contact.create', compact('companies'));
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
        if ($request->type == 'B2C') {
            $contact->company_id = null;
        }
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

        return redirect()->intended(route('contact.' . $redirectRoute))->with('success', 'Contact created successfully.');
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
     * Export the list of contacts to a CSV file.
     */
    public function exportContacts()
    {
        return Excel::download(new ContactsExport, 'contacts.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    /**
     * Import the list of contacts from a CSV file.
     */
    public function importContacts(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:csv,txt',
        ]);

        try {
            Excel::import(new ContactsImport, $request->file('import_file'));
            return redirect()->back()->with('success', 'Contacts imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing contacts: ' . $e->getMessage());
        }
    }

    public function showImportForm()
    {
        return view('contact.import');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $companies = Company::orderBy('name')->get();
        return view('contact.edit', compact('contact', 'companies'));
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

        if ($validatedData['type'] == 'B2C') {
            $validatedData['company_id'] = null;
        }
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


        return redirect()->intended(route('contact.' . $redirectRoute))->with('success', 'Contact updated successfully.');
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

        return redirect()->route('contact.' . $redirectRoute)->with('success', 'Contact deleted successfully.');
    }

    public function updateStatus($id, $type)
    {
        $contact = Contact::find($id);
        if ($contact) {
            if ($type === 'client') {
                $contact->status = 'client';
            } else {
                $contact->status = 'prospect';
            }
            $contact->save();
        }
    
        return redirect()->back();
    }
    
}
