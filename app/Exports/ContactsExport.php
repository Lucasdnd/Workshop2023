<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $contacts = Contact::with('actions')->get();

        return $contacts;
    }

    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Address',
            'City',
            'State',
            'Zip Code',
            'Country',
            'Company',
            'Status',
            'Type',
            'Last Action Type',
            'Last Action Comment',
        ];
    }

    public function map($contact): array
    {
        $lastAction = $contact->actions->last();

        return [
            $contact->id,
            $contact->first_name,
            $contact->last_name,
            $contact->email,
            $contact->phone,
            $contact->address,
            $contact->city,
            $contact->state,
            $contact->zip_code,
            $contact->country,
            $contact->company ? $contact->company->name : '',
            $contact->status,
            $contact->type,
            $lastAction ? $lastAction->type : '',
            $lastAction ? $lastAction->comment : '',
        ];
    }
}
