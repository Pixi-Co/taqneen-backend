<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerForm extends Model
{
    public static $SUBSCRIBE_TAMMM_MODEL_KEY = "subscribe_tamm_model";
    public static $SUBSCRIBE_SHOMOOS_MODEL_KEY = "subscribe_shomoos_model";
    public static $SUBSCRIBE_NABA_MODEL_KEY = "subscribe_naba_model";
    public static $SUBSCRIBE_MUQEEM_MODEL_KEY = "subscribe_muqeem_model";
    public static $SUBSCRIBE_MASARAT_MODEL_KEY = "subscribe_masarat_model";
    public static $EDIT_SUBSCRIPE_MUQEEM_MODEL_KEY = "edit_subscribe_muqeem_model";



    protected $table = "customer_forms";

    protected $fillable = [
        'key', 'value', 'customer_id', 'number', 'created_by'
    ];

    public function customer()
    {
        return $this->belongsTo(Contact::class, "customer_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function form($attr)
    {
        $attr = "'$attr'";
        $data = json_decode($this->value, true);

        return isset($data[$attr]) ? $data[$attr] : '';
    }

    public function assignData() {
        $data = json_decode($this->value);
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function getCustomerId()
    {
        $user_id = auth()->user()->id;
        $contact = Contact::where('converted_by', $user_id)->first();
        $customer_id = $contact ? $contact->id : $user_id;

        return $customer_id;
    }

    public static function createOrUpdate($key, $text, $customer_id = null)
    {
        if (!$customer_id) {
            $customer_id = self::getCustomerId();
        }

        //$resource = CustomerForm::where('key', $key)->where('customer_id', $customer_id)->first();

        $resource = self::create([
            "key" => $key,
            "value" => $text,
            "customer_id" => $customer_id,
            "created_by" => auth()->user()->id,
            "number" => time(),
        ]);

        $resource = $resource->refresh();


        // $resource->update([
        //     "value" => $text
        // ]);

        return $resource;
    }

    
    public function getTagValue($tag) {  
        $resource = $this; 
        //$resource->invoice_url = url('/subscriptions/print') . "/" . $this->getTokenAttribute();
        return $resource->$tag;
    }
}
