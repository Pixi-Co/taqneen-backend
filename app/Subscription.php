<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Subscription extends Transaction
{ 
    
    use SoftDeletes;

    public static $WAITING = "waiting";
    public static $PROCESSING = "processing";
    public static $PAY_PENDING = "pay_pending";
    public static $ACTIVE = "active";
    public static $CANCEL = "cancel";
    protected $appends = ['token'];

    public function getTokenAttribute() {
        if (!$this->invoice_token) {
            $this->invoice_token = randToken();
            $this->update();
        }

        return $this->invoice_token;
    }

    public function getExpireDate() {
        if ($this->expire_date)
            return $this->expire_date;
        $Transdate = $this->transaction_date;
        $date = Carbon::createFromFormat("Y-m-d H:i:s", $Transdate);
        return $date->addYear()->format('Y-m-d');
    }

    public function isExpire() {
        $today = time();
        $expire = $today > strtotime($this->expire_date)? 1 : '0';
        $this->is_expire = $expire;
        $this->update();

        return $expire == 1? true : false;
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
        $url = url('/subscriptions/print') . "/" . $this->getTokenAttribute();
 
        $resource = DB::table('transactions')
            ->select(
                "*",
                "transaction_date as subscription_date",
                DB::raw( "'".$url."' as invoice_url"),
                DB::raw( "(select name from contacts where contacts.id = contact_id) as contact_name"),
                DB::raw( "(select name from contacts where contacts.id = contact_id) as customer"),
                DB::raw("(select first_name from users where users.id = created_by) as sales_commission"),
                DB::raw("(select method from transaction_payments where transaction_payments.transaction_id = transactions.id) as payment_method"),
                DB::raw("(select paid_on from transaction_payments where transaction_payments.transaction_id = transactions.id) as paid_on"),
            )->first(); 

 
        //$resource->invoice_url = url('/subscriptions/print') . "/" . $this->getTokenAttribute();
        return optional($resource)->$tag;
    }

    public static function getExpireSubscriptionAfterOneDay() {
        $now = Carbon::now()->addDays(1)->format('Y-m-d');
        $subscriptions = Transaction::where('business_id', session('business.id'))->where('transaction_date', 'like', '%'.$now.'%')->get();

        return $subscriptions;
    }

    public function getExpireStatusForCalendar() {
        $now = Carbon::now()->addDays(30)->format('Y-m-d');
        
        if (str_contains($this->transaction_date, $now)) {
            return [
                "will_expire_in_month", "#ffeb3b"
            ];
        }

        if (str_contains($this->expire_date, $now)) {
            return [
                "expired", "#f44336"
            ];
        }

        return [
            "active", "#4CAF50"
        ];
    }
 
    public function scopeOnlyMe($query) {
        $ids1 = DB::table('transactions')->where('created_by', auth()->user()->id)->pluck('contact_id')->toArray();
        $ids2 = DB::table('contacts')->where('created_by', session('user.id'))->pluck('id')->toArray();
        $ids = array_merge($ids1, $ids2);
        
        return $query->whereIn('contact_id', $ids);
    }
}
