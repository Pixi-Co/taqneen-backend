<?php

namespace App\Imports;

use App\Contact;
use App\ServicePackage;
use App\Subscription;
use App\TaxRate;
use App\Transaction;
use App\User;
use Carbon\Carbon;
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
        $row['payment_data'] = $this->getDate($row['payment_data']);
        $row['start_date'] = $this->getDate($row['start_date']);
        

        dd([
            $row
        ]);
        try {
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
        } catch (\Exception $th) {
            return null;
        }
    }

    public function getDate($string) {
        $date = date('Y-m-d');
        $arr = explode("/", $string);
        return count($arr) > 1? $arr['2'] . "-". $arr['0'] . "-" . $arr['1'] : null;
    }

    public function createCustomer(array $row)
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
            "mobile" => $row['phone']?? '-',
            "email" => $row['email']?? '-',
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

    public function createUser(Contact $contact, array $data)
    {
        $user = $contact->loginUser;
        $contact = $contact->refresh();


        $fill = [
            "first_name" => $contact->first_name,
            "last_name" => $contact->last_name,
            "email" => $contact->email,
            "contact_number" => $contact->mobile,
            "address" => $contact->address_line_1,
            "user_type" => 'user_customer',
            "password" => isset($data['password']) ? bcrypt($data['password']) : '',
        ];

        if ($user) {
            $user->update($fill);
        } else {
            $user = User::create($fill);
        }

        $role = "customer";
        $user->assignRole($role);

        return $user->refresh();
    }

    public function assignUserToCustomer(Contact $customer, User $user)
    {
        $customer->update([
            "converted_by" => $user->id
        ]);
        return true;
    }

    public function createSubscription(array $row, Contact $customer)
    {
        $tax = TaxRate::where('business_id', session('business.id'))->first();
        $final_total = $row['expense_amount']?? 0;
        $total = 0;
        $servicePrices = explode(",", $row['price']);

        foreach ($servicePrices as $price) {
            $price = str_replace(' ', "", $price);
            $final_total += is_numeric($price) ? $price : 0;
            $total += is_numeric($price) ? $price : 0;
        }

        $date = date('Y-m-d H:i:s', strtotime($row['start_date']));

        $taxAmount = 0;
        if (isset($row['tax_amount']))
            $taxAmount = ($total * ($row['tax_amount'] / 100));

        $final_total += $taxAmount;

        $data = [
            "status" => $row['order_status'],
            "contact_id" => $customer->id,
            "created_by" => $row['sales_agent_id'],
            "tax_id" => optional($tax)->id,
            "tax_amount" => $row['tax_amount'],
            "custom_field_1" => null,  // expenses ids
            "custom_field_2" => $taxAmount,  // expenses amount
            "custom_field_4" => '',  // expenses amount
            "final_total" => $final_total,  // expenses amount
            "transaction_date" => $date,  // expenses amount
            "sub_type" => $row['paper'],  // expenses amount
            "shipping_custom_field_2" => $row['payment_status']?? '',  // expenses amount
            "business_id" => session('business.id'),
        ];
 
        // insert transactions
        $resource = Transaction::create($data);
        $resource = Subscription::find($resource->id);
        $resource->expire_date = $resource->getExpireDate();
        $resource->update();

        return $resource;
    }

    public function createSubscriptionLines(array $row, Subscription $subscription)
    {
        $packages = explode(",", $row['packages']);
        $servicePrices = explode(",", $row['price']);

        // insert subscription lines
        for ($index = 0; $index < count($packages); $index++) {
            $item = $packages[$index];
            $price = str_replace(' ', "", isset($servicePrices[$index]) ? $servicePrices[$index] : '0');
            $package = ServicePackage::find($item);
            if ($package) {
                DB::table('subscription_lines')->insert([
                    "transaction_id" => $subscription->id,
                    "service_id" => $package->service_id,
                    "package_id" => $package->id,
                    "total" =>  is_numeric($price) ? $price : 0
                ]);
            }
        }

        return true;
    }

    public function createSubscriptionPayment(array $row, Subscription $subscription)
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
