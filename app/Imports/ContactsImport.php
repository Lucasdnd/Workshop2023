<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ContactsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Contact([
            'first_name' => $row['First Name'],
            'last_name' => $row['Last Name'],
            'email' => $row['Email'],
            'phone' => $row['Phone'],
            'address' => $row['Address'],
            'city' => $row['City'],
            'state' => $row['State'],
            'zip_code' => $row['Zip Code'],
            'country' => $row['Country'],
            'status' => $row['Status'],
            'type' => $row['Type'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function useFirstRowAsHeader(): bool
    {
        return true;
    }
}
