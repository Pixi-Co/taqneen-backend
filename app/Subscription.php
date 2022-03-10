<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Transaction
{
    
    //protected $appends = ['expire_date'];

    public function getExpireDateAttribute() {
        $Transdate = $this->transaction_date;
        $date = Carbon::createFromFormat("Y-m-d H:i:s", $Transdate);
        return $date->addYear()->format('Y-m-d');
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
}
