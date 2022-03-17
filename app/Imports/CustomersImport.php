<?php

namespace App\Imports;

use App\Contact;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class CustomersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        // create contact
        $contact = new Contact([
            'supplier_business_name'  => $row['supplier_business_name'],
            "custom_field1"  => $row['custom_field1'],
            "mobile"  => $row['mobile'],
            "state"  => $row['state'],
            "address_line_1"  => $row['address_line_1'],
            "address_line_2"  => $row['address_line_2'],
            "zip_code"  => $row['zip_code'],
            "first_name"  => $row['first_name'],
            "last_name"  => $row['last_name'],
            "name"  => implode(" ", [$row['first_name'], $row['last_name']]),
            "email"  => $row['email'], 
            "business_id" =>session('business.id'),
            "created_by" => session('user.id'),
            "type" => 'customer',
        ]);

        // create user
        $user = $this->createUser($contact->refresh(), $row);

        $contact->update([
            "converted_by" => $user->id
        ]);

        return $contact;
    }

    public function createUser(Contact $contact, $data) {
        $user = $contact->loginUser; 
 
        $data=[
            "first_name" => $contact->first_name,
            "last_name" => $contact->last_name,
            "email" => $contact->email,
            "contact_number" => $contact->mobile,
            "address" => $contact->address_line_1,
            "password" => isset($data['password'])? bcrypt($data['password']) : '',
        ]; 

        $user = !$user? User::create($data) : $user->update($data);   

        if (isset($data['role']))  {
            $role = $user->roles()->first();  
            $newRole = Role::find($data['role']); 
            $user->removeRole($user->roles()->pluck('name')->toArray()); 
            $user->roles()->detach();
            $user->forgetCachedPermissions();
            $user->assignRole($newRole->name);
        }

        return $user;
    }
 
}
