<?php

namespace App\Imports;

use App\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OpportunitImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            "name" => $row['name'],
            "mobile" => $row['mobile'],
            "email" => $row['email'],
            "custom_field2" =>$row['service_id'], // service ,
            "custom_field3" => $row['package_id'], // package,
            "dob" => date('Y-m-d', strtotime($row['publish_date'])),
            "business_id" =>session('business.id'),
            "created_by" => session('user.id'),
            "type" => 'opportunity',
        ]);
    }
}
