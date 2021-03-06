<?php

namespace App\Http\Controllers\taqneen;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerForm;
use App\Media;
use App\Subscription;
use App\System;
use App\Triger;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Spatie\Permission\Models\Role;
use Spipu\Html2Pdf\Html2Pdf;

class CustomerFormController extends Controller
{
    public function pdfViewer()
    {
        $defaultKey = request()->key ? request()->key : CustomerForm::$KEYS[0];
        $keys = CustomerForm::$KEYS;
        $image = CustomerForm::$KEYS_IMAGES[$defaultKey];

        $resource = CustomerForm::where('key', $defaultKey)->latest()->first();


        if (request()->reset) {
            $setting = System::where('key', $defaultKey)->first();
            $resourceData = json_decode($resource->value, true);
            $newDate = [];
            foreach ($resourceData as $k => $v) {
                $newDate[$k] = $k;
            }

            $json = json_encode(json_encode($newDate));

            if (!$setting) {
                $setting = System::create([
                    "key" => $defaultKey,
                    "value" => $json,
                ]);
            } else {
                $setting->update([
                    "value" => $json
                ]);
            }

            return redirect("customer-pdf-viewer?key=" . $defaultKey);
        }

        if (request()->ajax()) {
            $key = request()->key;
            $data = request()->data;
            $setting = System::where('key', $defaultKey)->first();

            if (!$setting) {
                $setting = System::create([
                    "key" => $key,
                    "value" => json_encode($data),
                ]);
            } else {
                $setting->update([
                    "value" => json_encode($data)
                ]);
            }

            return 1;
        }

        $setting = System::where('key', $defaultKey)->first();
        if (!$setting)
            $setting = new System();

        $data = json_decode(json_decode($setting->value));
        if (!$data)
            $data = new System();

        if (request()->sync == 1) {
            $resourceData = json_decode($resource->value, true);
            foreach ($resourceData as $k => $v) {
                if (!optional($data)->$k) {
                    $data->$k = $k;
                }
            }
        }

        return view("taqneen.customer_forms.pdf-viewer", compact("resource", "setting", "data", "keys", "image"));
    }


    public function index($key)
    {
        $instance = CustomerForm::class;
        $customer_id = CustomerForm::getCustomerId();
        $resources = CustomerForm::where('key', $key)->where(function ($query) use ($customer_id) {
            if (!auth()->user()->isAdmin()) {
                $query->where('created_by', auth()->user()->id);
            }
        })->get();
        //dd($resource);
        foreach ($resources as $item) {
            $item->assignData();
        }

        return view('taqneen.customer_forms.index', compact('resources', 'key'));
    }


    public function create($key)
    {
        if (!auth()->user()) {
            $this->preAccount();
        }
        $resource = new CustomerForm();
        try {
            return view("taqneen.customer_forms.form", compact('key', 'resource'));
        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect("/login");
        }
    }

    public function viewFinalPage($key) {
        if (!auth()->user())
            $this->preAccount();

        $resource = CustomerForm::where("number", $key)->first();
        if (!$resource)
            abort(404);

        $key = $resource->key;
        $resource->assignData();
        return view("taqneen.customer_forms.final", compact('key', 'resource'));
    }


    public function edit($id)
    {
        $resource = CustomerForm::find($id);
        $key = $resource->key;
        $resource->assignData();
        return view("taqneen.customer_forms.form", compact('key', 'resource'));
    }

    public function editApi($token)
    {
        $resource = CustomerForm::where("number", $token)->first();
        if (!$resource)
            abort(404);

        $key = $resource->key;
        $resource->assignData();
        return view("taqneen.customer_forms.form", compact('key', 'resource'));
    }


    public function save(Request $request)
    {
        $key = $request->key;
        $id = $request->id;
        $form = $request->form;
        $customerId = CustomerForm::getCustomerId();
        $userId = auth()->user()->id;
        $json = json_encode($form);

        if ($id) {
            $resource = CustomerForm::find($id);
            $resource->update([
                "value" => $json
            ]);
        } else {
            $resource = CustomerForm::create([
                "key" => $key,
                "customer_id" => $customerId,
                "created_by" => $userId,
                "number" => $form['token'] ?? time(),
                "value" => $json,
            ]);

            // fire triger
            // assign data 
            $resource->assignData();
            Triger::fire2(Triger::$ADD_CUSTOMER_FORM, $resource);
        }

        return redirect("/customer-form-pdf/" . $resource->number);
    }

    public function viewPdfApi($id)
    {
        return $this->viewPdf($id);
    }

    public function downloadPdfApi($id)
    {
        return $this->viewPdf($id, true);
    }

    public function viewPdf($id, $download = false)
    {
        $resource = CustomerForm::find($id);
        $key = $resource->key;
        $resource->courier_name = optional($resource->courier())->user_full_name;
        $file = $key;


        if (!$resource)
            $resource = new CustomerForm();

        $setting = System::where('key', $resource->key)->first();
        $options = json_decode(json_decode(optional($setting)->value), true);

        $data = json_decode($resource->value, true);
        $data['courier_name'] = $resource->courier_name;
        $html = view('taqneen.customer_forms.pdf', compact('resource', 'data', 'options'))->render();


        return $this->getPdf1($html, $download);
    }


    public function uploadPdf(Request $request)
    {
        if (!auth()->user())
            $this->preAccount();
        
        $validator = validator($request->all(), [
            "file" => 'required|max:10000|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first());
        }
        $resource = CustomerForm::find($request->id);
        // insert media
        Media::uploadMedia(session('business.id'), $resource, $request, "file", false, "App\CustomerForm");

        return responseJson(1, __('file_uploaded'));
    }

    public function getPdf1($html, $download = false)
    {
        $stylesheet = file_get_contents('css/customer_forms.css');

        //$pdf = PDF::loadHTML($html);  
        $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297]]);

        $pdf->autoScriptToLang = true;
        $pdf->baseScript = 1;
        $pdf->autoVietnamese = true;
        $pdf->autoArabic = true;
        $pdf->autoLangToFont  = true;

        $pdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $pdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        return $download ? $pdf->Output('form.pdf', 'D') : $pdf->output();
    }

    public function getPdf2($html)
    {
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($html);
        $html2pdf->output('myPdf.pdf');
    }

    public function createAccount(Request $request)
    {

        $validator = validator($request->all(), [
            "email" => "email|required|unique:users,email|max:191",
            "pc_number" => "required|unique:contacts,custom_field1|max:191",
            "name" => "required|max:191",
            "password" => "required|max:191|min:8",
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first());
        }

        $customer = Contact::where('custom_field1', $request->pc_number)->first();
        $names = explode(" ", $request->name);
        $first_name = $names[0];
        $last_name = str_replace($first_name, "", $request->name);

        $customer = Contact::create([
            "supplier_business_name" => $request->name,
            "custom_field1" => $request->pc_number,
            "mobile" => $request->email,
            "email" => $request->email,
            "state" => '',
            "address_line_1" => '',
            "zip_code" => '',
            "first_name" => $first_name,
            "last_name" => $last_name,
            "name" =>  $request->name,
            "business_id" => 19,
            "created_by" => optional(User::first())->id,
            "type" => 'customer',
        ]);
        $customer = $customer->refresh();

        $userData = [
            "password" => $request->password,
            "role" => "customer"
        ];
        $user = $this->createUser($customer, $userData);
        $customer->update([
            "converted_by" => $user->id,
        ]);
        return responseJson(1, __('your_account_has_been_created'));
    }

    public function quickAccessAccount(Request $request)
    {

        $validator = validator($request->all(), [
            "email" => "email|required|unique:users,email|max:191",
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first());
        }

        $customer = Contact::where('email', $request->email)->first();

        if (!$customer)
            $customer = Contact::create([
                "supplier_business_name" => '-',
                "custom_field1" => '-',
                "mobile" => $request->email,
                "email" => $request->email,
                "state" => '',
                "address_line_1" => '',
                "zip_code" => '',
                "first_name" => '-',
                "last_name" => '-',
                "name" =>  '-',
                "business_id" => 19,
                "created_by" => optional(User::first())->id,
                "type" => 'customer',
            ]);
        $customer = $customer->refresh();

        $userData = [
            "password" => $request->email,
            "role" => "customer"
        ];
        $user = $this->createUser($customer, $userData);
        $customer->converted_by = $user->id;
        $customer->update();

        Auth::login($user);
        return responseJson(1, __('your_account_has_been_created'));
    }

    public function createUser(Contact $contact, array $data)
    {
        $user = $contact->loginUser;

        if (!$user)
            $user = User::where('email', $contact->email)->first();

        $contact = $contact->refresh();

        $fill = [
            "first_name" => $contact->first_name,
            "last_name" => $contact->last_name,
            "email" => $contact->email,
            "username" => $contact->email,
            "contact_number" => $contact->mobile,
            "address" => $contact->address_line_1,
            "user_type" => 'user_customer',
            "business_id" => '19',
            "password" => isset($data['password']) ? bcrypt($data['password']) : '',
        ];

        if ($user) {
            $user->update($fill);
        } else {
            $user = User::create($fill);
        }

        //$data['role'] = strtolower($data['role']) . "#19"; 
        $user->assignRole('customer');

        return $user->refresh();
    }

    public function destroy($id)
    {
        try {
            $subscribe_customer = CustomerForm::find($id);
            $subscribe_customer->delete();

            $output = [
                "success" => 1,
                "msg" => __('delete successfull')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }

        return $output;
    }

    public function preAccount()
    {
        $ip = request()->ip();
        $email = $ip . "@taqneen.com";
        $password = "123456789";

        $customer = Contact::where('email', $email)->first();

        if (!$customer)
        $customer = Contact::create([
            "supplier_business_name" => $ip,
            "custom_field1" => '-',
            "mobile" => $ip,
            "email" => $email,
            "state" => '-',
            "address_line_1" => '-',
            "zip_code" => '-',
            "first_name" => '-',
            "last_name" => '-',
            "name" =>  '-',
            "business_id" => 19,
            "created_by" => optional(User::first())->id,
            "type" => 'customer',
        ]);
        $customer = $customer->refresh();
        $userData = [
            "password" => $password,
            "role" => "customer"
        ];
        $user = $this->createUser($customer, $userData);
        $customer->converted_by = $user->id;
        $customer->update();
        $customer = $customer->refresh();
        Auth::login($user);
        return $customer ;
    }

    public function preAccountForGuest($request)
    {
        $ip = request()->ip();
        $email = $request->client_email;
        $password = "123456789";

        $customer = Contact::where('email', $email)->orWhere('custom_field1',$ip)->first();

        if (!$customer)
            $customer = Contact::create([
                "supplier_business_name" => $ip,
                "custom_field1" => $request->computer_num,
                "mobile" => $request->client_phone,
                "email" => $email,
                "state" => '-',
                "address_line_1" => '-',
                "zip_code" => '-',
                "first_name" => $request->client_name,
                "last_name" => $request->client_name,
                "name" =>  $request->client_name,
                "business_id" => 19,
                "created_by" => optional(User::first())->id,
                "type" => 'customer',
            ]);
        $customer = $customer->refresh();
        $userData = [
            "password" => $password,
            "role" => "customer"
        ];
        $user = $this->createUser($customer, $userData);
        $customer->converted_by = $user->id;
        $customer->update();
        $customer = $customer->refresh();
        Auth::login($user);
        return $customer ;
    }
}
