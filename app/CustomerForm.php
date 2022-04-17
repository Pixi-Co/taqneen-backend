<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerForm extends Model
{
    public static $KEYS = [
        "MASARAT",
        "MUQEEM",
        "TAMM",
        "SHUMOUS",
        "NABA",
        "TAMM_EDIT",
        "MUQEEM_EDIT",
    ];

    public static $KEYS_IMAGES = [
        "MUQEEM" => [
            "/assets/images/muqeem-pdf/page1.png",
            "/assets/images/muqeem-pdf/page2.png",
        ],
        "TAMM" => [
            "/assets/images/tamm-pdf/page1.png",
            "/assets/images/tamm-pdf/page2.png",
        ],
        "SHUMOUS" => [
            "/assets/images/shomoos-pdf/page.png"
        ],
        "MASARAT" => [
            "/assets/images/masarat-pdf/page.jpg"
        ],
        "NABA" => [
            "/assets/images/naba-pdf/page1.png",
            "/assets/images/naba-pdf/page2.png",
            "/assets/images/naba-pdf/page3.png",
            "/assets/images/naba-pdf/page4.png",
            "/assets/images/naba-pdf/page5.png"
        ],
        "TAMM_EDIT" => [
            "/assets/images/tamm-pdf/edit_form_tam.png"
        ],
        "MUQEEM_EDIT" => [
            "/assets/images/muqeem-pdf/muqeem_edit.png",
        ],
    ];



    protected $table = "customer_forms";

    protected $fillable = [
        'key', 'value', 'customer_id', 'number', 'created_by'
    ];

    public function customer()
    {
        return $this->belongsTo(Contact::class, "customer_id");
    }

    public function courier()
    {
        $data = json_decode($this->value);
        return isset($data->courier_name)? User::find($data->courier_name) : new User();
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

    public function assignData()
    {
        $data = json_decode($this->value);
        foreach ($data as $key => $value) {
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

    public function getTagValue($tag)
    {
        $this->assignData();
        $resource = $this;
        $resource->customer_form_name = __($this->key);
        $resource->customer_form_user = optional($this->user)->first_name;
        $resource->user_triger_email = $this->user_triger_email;
        $resource->customer_form_pdf_url = url('/customer-pdf') . "/" . $this->id;
        $resource->customer_form_pdf = "<a href='" . url('/customer-pdf-download') . "/" . $this->id . "' ><div style='margin: auto;border: 1px solid lightgray;text-align: center;width: 100px;border-radius: 6px;box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;' ><img style='width: 100px;' src='" . url('/images/pdf_file.jpg') . "' ><br> <b>تحميل</b> </div></a><br>";
        //$resource->invoice_url = url('/subscriptions/print') . "/" . $this->getTokenAttribute();
        return $resource->$tag;
    }
}
