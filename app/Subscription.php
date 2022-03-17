<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Transaction
{
    
    //protected $appends = ['expire_date'];

    public function getExpireDate() {
        $Transdate = $this->transaction_date;
        $date = Carbon::createFromFormat("Y-m-d H:i:s", $Transdate);
        return $date->addYear()->format('Y-m-d');
    }

    public function getTransformPhotoUrlAttribute() {
        return $this->custom_field_3? url('/uploads') . "/" . $this->custom_field_3 : null;
    }

    public function getServiceNamesAttribute() {
        return implode(",", $this->subscription_lines()
        ->select(
            '*',
            DB::raw('(select name from categories where categories.id = service_id) as service_name')
        )
        ->pluck('service_name')->toArray());
    }
    
    public function media() {
        return Media::where('business_id', session('business.id'))
        ->where('model_type', "App\Transaction")
        ->where('model_id', $this->id);
    }

    public function contact() {
        return $this->belongsTo(Contact::class, "contact_id");
    }

    public function subscription_lines() {
        return $this->hasMany(SubscriptionLine::class, "transaction_id");
    }

    public function subscription_notes() {
        return $this->hasMany(SubscriptionNote::class, "transaction_id");
    }

    public function getTotal() {
        $total = 0;
        foreach($this->subscription_lines()->get() as $item) {
            $total += $item->total;
        }

        return $total;
    }

    public function payment() {
        return $this->belongsTo(TransactionPayment::class, "transaction_id");
    }

    public function user() {
        return $this->belongsTo(User::class, "created_by");
    }

    public function getTagValue($tag) {
        $resource = DB::table('transactions')
            ->select(
                "*",
                "transaction_date as subscription_date",
                "(select name from contacts where contacts.id = contact_id) as contact_name",
                "(select name from users where users.id = created_by) as sales_commission",
                "(select method from transaction_payments where transaction_payments.transaction_id = transactions.id) as payment_method",
                "(select paid_on from transaction_payments where transaction_payments.transaction_id = transactions.id) as pay_date",
            )->first();

        return $resource->$tag;
    }

    
}
