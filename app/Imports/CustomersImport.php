<?php

namespace App\Imports;

use App\Contact;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'supplier_business_name'  => $row['supplier_business_name'],
            "custom_field1"  => $row['custom_field1'],
            "mobile"  => $row['mobile'],
            "state"  => $row['state'],
            "address_line_1"  => $row['address_line_1'],
            "address_line_2"  => $row['address_line_2'],
            "zip_code"  => $row['zip_code'],
            "first_name"  => $row['first_name'],
            "last_name"  => $row['last_name'],
            "name"  => $row['first_name'].$row['last_name'],
            "email"  => $row['email'],
            "password"  => Hash::make('password'),
            "business_id" =>session('business.id'),
            "created_by" => session('user.id'),
            "type" => 'customer',
        ]);
    }
}
