<?php

namespace App\Imports;

use App\Contact;
use App\ServicePackage;
use App\Subscription;
use App\TaxRate;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class SubscriptionImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // step 1 => create customer
        $customer = $this->createCustomer($row);

        // step 2 => creat User of customer
        $user = $this->createUser($customer, $row);

        // step 3 => assign user to customer 
        $this->assignUserToCustomer($customer, $user);

        // step 4 => creat subscription
        $subscription = $this->createSubscription($row, $customer);

        // step 5 => create subscription lines 
        $this->createSubscriptionLines($row, $subscription);

        // step 6 => create subscription payment 
        $this->createSubscriptionPayment($row, $subscription);

        return $subscription;
    }

    public function createCustomer($row)
    {
        $customer = Contact::where('custom_field1', $row['pc_number'])->first();
        if ($customer) {
            return $customer;
        }

        $names = explode(" ", $row['person']);
        $first_name = $names[0];
        $last_name = str_replace($first_name, "", $row['person']);
 
        $customer = Contact::create([
            "supplier_business_name" => $row['company'],
            "custom_field1" => $row['pc_number'],
            "mobile" => $row['phone'],
            "email" => $row['email'],
            "state" => $row['state'],
            "address_line_1" => $row['address'],
            "zip_code" => $row['zip_code'],
            "first_name" => $first_name,
            "last_name" => $last_name,
            "name" =>  $row['person'],
            "business_id" => session('business.id'),
            "created_by" => session('user.id'),
            "type" => 'customer',
        ]);

        $customer = $customer->refresh();
        return $customer;
    }

    public function createUser(Contact $contact, $data)
    {
        $user = $contact->loginUser; 

 
        $userData = [
            "first_name" => $contact->first_name,
            "last_name" => $contact->last_name,
            "email" => $contact->email,
            "contact_number" => $contact->mobile,
            "address" => $contact->address_line_1,
            "user_type" => 'user_customer',
            "password" => isset($data['password']) ? bcrypt($data['password']) : '',
        ];
        //dd($userData);

        $user = !$user ? User::create($userData) : $user->update($userData);
 

        if (isset($data['role'])) {
            $data['role'] = strtolower($data['role']) . "#" . session('business.id');
            $role = $user->roles()->first();
            $newRole = Role::where('name', $role)->first();
            if ($newRole) {
                if ($role)
                $user->removeRole($role->name);
                $user->roles()->detach();
                $user->forgetCachedPermissions();
                $user->assignRole($newRole->name);
            }
        }

        return $user->refresh();
    }

    public function assignUserToCustomer(Contact $customer, User $user)
    {
        $customer->update([
            "converted_by" => $user->id
        ]);
        return true;
    }

    public function createSubscription($row, Contact $customer)
    {
        $tax = TaxRate::where('business_id', session('business.id'))->first();
        $final_total = $row['tax_amount'] + $row['expense_amount'];
        $servicePrices = explode(",", $row['price']);

        foreach ($servicePrices as $price) {
            $price = str_replace(' ', "", $price);
            $final_total += $price;
        }

        $date = date('Y-m-d H:i:s', strtotime($row['start_date']));

        $data = [
            "status" => $row['order_status'],
            "contact_id" => $customer->id,
            "created_by" => $row['sales_agent_id'],
            "tax_id" => optional($tax)->id,
            "tax_amount" => $row['tax_amount'],
            "custom_field_1" => null,  // expenses ids
            "custom_field_2" => $row['expense_amount'],  // expenses amount
            "custom_field_4" => '',  // expenses amount
            "final_total" => $final_total,  // expenses amount
            "transaction_date" => $date,  // expenses amount
            "sub_type" => $row['paper'],  // expenses amount
            "business_id" => session('business.id'),
        ];

        //dd($request->all());

        // insert transactions
        $resource = Subscription::create($data);
        $resource = $resource->refresh();
        $resource->expire_date = $resource->getExpireDate();
        $resource->update();

        return $resource;
    }

    public function createSubscriptionLines($row, Subscription $subscription)
    {
        $packages = explode(",", $row['packages']);
        $servicePrices = explode(",", $row['price']);

        // insert subscription lines
        for ($index = 0; $index < count($packages); $index++) {
            $item = $packages[$index];
            $price = str_replace(' ', "", isset($servicePrices[$index])? $servicePrices[$index] : '0');
            $package = ServicePackage::find($item);
            if ($package) {
                DB::table('subscription_lines')->insert([
                    "transaction_id" => $subscription->id,
                    "service_id" => $package->service_id,
                    "package_id" => $package->id,
                    "total" => $price
                ]);
            }
        }

        return true;
    }

    public function createSubscriptionPayment($row, Subscription $subscription)
    {
        $date = date('Y-m-d H:i:s', strtotime($row['payment_data']));
        // insert payment 
        DB::table('transaction_payments')->insert([
            "transaction_id" => $subscription->id,
            "transaction_no" => $subscription->id,
            "business_id" => session('business.id'),
            "created_by" => session('user.id'),
            "amount" => $subscription->final_total,
            "method" => $row['payment_method'],
            "paid_on" => $date,
        ]);
    }
}
