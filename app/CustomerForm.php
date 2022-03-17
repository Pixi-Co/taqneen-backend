<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerForm extends Model
{
    protected $table = "customer_forms";

    protected $fillable = [
        'key', 'value', 'customer_id', 'number'
    ];

    public function customer()
    {
        return $this->belongsTo(Contact::class, "customer_id");
    }

    public function form($attr) {
        $attr = "'$attr'";
        $data = json_decode($this->value, true);

        return isset($data[$attr])? $data[$attr] : '';
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

        $resource = CustomerForm::where('key', $key)->where('customer_id', $customer_id)->first();

        if (!$resource) {
            $resource = self::create([
                "key" => $key,
                "value" => $text,
                "customer_id" => $customer_id,
                "number" => time(),
            ]);

            $resource = $resource->refresh();
        }

        $resource->update([
            "value" => $text
        ]);

        return $resource;
    }
}
