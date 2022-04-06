<?php

namespace App\Http\Controllers\taqneen;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerForm;
use App\System;
use App\Triger;
use App\User;
use PDF;
use Spatie\Permission\Models\Role;
use Spipu\Html2Pdf\Html2Pdf;

class CustomerFormController extends Controller
{
    public function pdfViewer() { 
        $defaultKey = request()->key? request()->key : "subscribe_masarat_model";
        $keys = [
            "subscribe_masarat_model" => url('/assets/images/masarat-pdf/page.jpg'),
            "subscribe_muqeem_model" => url('/assets/images/muqeem-pdf/page.png'),
            "subscribe_naba_model" => url('/assets/images/naba-pdf/page1.png'),
            "subscribe_shomoos_model" => url('/assets/images/shomoos-pdf/page.png'),
            "subscribe_tamm_model" => url('/assets/images/tamm-pdf/page1.png'),
            "edit_subscribe_muqeem_model" => url('/assets/images/muqeem-pdf/page.png'),
        ];
        $resource = CustomerForm::where('key', $defaultKey)->first(); 
        

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

        /*System::create([
            "key" => $resource->key,
            "value" => json_encode($resource->value),
        ]);
        return 1;*/
        $setting = System::where('key', $defaultKey)->first(); 
        if (!$setting)
            $setting = new System(); 

        $data = json_decode(json_decode($setting->value));  
        if (!$data)
            $data = new System(); 

        $data->image = $keys[$defaultKey];

        if (request()->is_sync == '1') {
            $resourceData = json_decode($resource->value, true);
            foreach($resourceData as $k => $v) {
                if (!optional($data)->$k) {
                    $data->$k = $k;
                }
            }
        } 
 
        return view("taqneen.customer_forms.pdf.viewer", compact("resource", "setting", "data", "keys"));
    }

    public function index($form){
        $instance = CustomerForm::class;
        $customer_id = CustomerForm::getCustomerId();
        $resources = CustomerForm::where('key', $form)->where('customer_id', $customer_id)->get(); 
        //dd($resource);
        foreach($resources as $item){
            $item->assignData();
        }
        $data = $resources;
        if($form == 'subscribe_tamm_model')
        {
            return view('taqneen.customer_forms.tamm.index' , compact('instance','data'));
        }
        elseif($form == 'subscribe_masarat_model')
        {
            return view('taqneen.customer_forms.masarat.index' , compact('instance','data'));
        }
        elseif($form == 'subscribe_muqeem_model')
        {
            return view('taqneen.customer_forms.muqeem.index' , compact('instance','data'));
        }
        elseif($form == 'subscribe_naba_model')
        {
            return view('taqneen.customer_forms.naba.index' , compact('instance','data'));
        }
        else
        {
            return view('taqneen.customer_forms.shomoos.index' , compact('instance','data'));
        }
    }


    public function create($form_name)
    {
        
        //variable to  shomoos form 'activity_type'
        $activity_type=[
            'وحدات ايواء' => 'وحدات ايواء',
            'محلات ذهب' => 'محلات ذهب',
            'تًٌَُُأجير السيارات' => 'تأجير السيارات',
            'المجمعات الخاصة' => 'المجمعات الخاصة',
            'المكاتب العقارية' => 'المكاتب العقارية',
            'مقاهي الانترنت' => 'مقاهي الانترنت',
            'شركة الحراسات الامنية الخاصة' => 'شركة الحراسات الامنية الخاصة',
            'السكك الحديدية' => 'السكك الحديدية',
        ];
        $subscribe_customer = new CustomerForm();
        $data = json_decode($subscribe_customer->value); 
        $instance = CustomerForm::class;
        return view('taqneen.customer_forms.' . $form_name, compact('instance','subscribe_customer','data','activity_type'));
    }
    
    public function edit($form_name,$id)
    {
        $subscribe_customer = CustomerForm::find($id);
        $data = json_decode($subscribe_customer->value);
        
        $instance = CustomerForm::class;
         //variable to  shomoos form 'activity_type'
         $activity_type=[
            'وحدات ايواء' => 'وحدات ايواء',
            'محلات ذهب' => 'محلات ذهب',
            'تًٌَُُأجير السيارات' => 'تأجير السيارات',
            'المجمعات الخاصة' => 'المجمعات الخاصة',
            'المكاتب العقارية' => 'المكاتب العقارية',
            'مقاهي الانترنت' => 'مقاهي الانترنت',
            'شركة الحراسات الامنية الخاصة' => 'شركة الحراسات الامنية الخاصة',
            'السكك الحديدية' => 'السكك الحديدية',
        ];

        if (!$data)
            $data = new CustomerForm();
            
        return view('taqneen.customer_forms.' . $form_name,compact('instance','data','subscribe_customer','activity_type'));
    } 


    public function viewPdfApi($id)
    { 
        $resource = CustomerForm::find($id);
        $key = $resource->key;
        
        return $this->viewPdf($resource, $key);
    }

    public function downloadPdfApi($id)
    { 
        $resource = CustomerForm::find($id);
        $file = $resource->key;   
        $setting = System::where('key', $resource->key)->first();
        $options = json_decode(json_decode($setting->value), true); 
 
        $data = json_decode($resource->value, true); 
        $html = view('taqneen.customer_forms.pdf.' . $file, compact('resource', 'data', 'options'))->render();
         
         
        //return $html;
        $stylesheet = file_get_contents('css/customer_forms.css');
        //$pdf = PDF::loadHTML($html);  
        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        //$pdf->WriteHTML($stylesheet2,\Mpdf\HTMLParserMode::HEADER_CSS);
        $pdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
        
        return $pdf->Output('form.pdf', 'D');
    }

    public function save(Request $request)
    {
        if ($request->id)
            return $this->update($request);

        try {
            $key = $request->customer_type;
            $value = json_encode($request->form);
            $resource = CustomerForm::createOrUpdate($key, $value);

            // fire triger after register customer form
            Triger::fire2(Triger::$ADD_CUSTOMER_FORM, $resource);

            return redirect("/customer-pdf/" . $resource->id);
            //return $this->viewPdf($resource, $key);
        } catch (Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
 
            return back()->with('status', $output);
        } 
    }
    public function update(Request $request){ 
            $key = $request->key;
            $value = json_encode($request->form); 
            $resource = CustomerForm::find($request->id);
            $resource->update([ 
                "value" => $value, 
            ]); 
            $output = [
                "success" => 1,
                "msg" =>__('done')
            ];

            $redir = "/customer-form/" . $resource->key . "/index";
            return redirect($redir)->with('status', $output);
    }

    public function viewPdf(CustomerForm $resource, $key)
    {
        $file = $key; 
        //$resource = CustomerForm::where('key', $key)->where('customer_id', $customer_id)->first();
        

        if (!$resource) 
            $resource = new CustomerForm();

        $setting = System::where('key', $resource->key)->first();

        $jsonData = stripslashes(html_entity_decode($setting->value));
        $options = json_decode(json_decode($jsonData), true); 
 
        $data = json_decode($resource->value, true); 
        $html = view('taqneen.customer_forms.pdf.' . $file, compact('resource', 'data', 'options'))->render();
        

        dd($setting->value);
 
        return $this->getPdf1($html); 
        //return view('taqneen.customer_forms.pdf.' . $file, compact('resource', 'data'));
    }


    public function getPdf1($html) {
        $stylesheet = file_get_contents('css/customer_forms.css');
        //$pdf = PDF::loadHTML($html);  
        $pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297]]);
        
        $pdf->autoScriptToLang = true;
        $pdf->baseScript = 1;
        $pdf->autoVietnamese = true;
        $pdf->autoArabic = true; 
        $pdf->autoLangToFont  = true; 

        $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        //$pdf->WriteHTML($stylesheet2,\Mpdf\HTMLParserMode::HEADER_CSS);
        $pdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY); 
        
        
        return $pdf->output();
    }

    public function getPdf2($html) {
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($html);
        $html2pdf->output('myPdf.pdf');
    }

    public function createAccount(Request $request) {
 
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
        $this->createUser($customer, $userData);

        return responseJson(1, __('your_account_has_been_created'));
    }

    public function createUser(Contact $contact, array $data)
    {
        $user = $contact->loginUser;
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


        if (isset($data['role'])) {
            $data['role'] = strtolower($data['role']) . "#19";
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
    
}
