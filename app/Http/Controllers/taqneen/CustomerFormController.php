<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerForm; 
use PDF;
use Spipu\Html2Pdf\Html2Pdf;

class CustomerFormController extends Controller
{

    public function index($form){
        $instance = CustomerForm::class;
        $customer_id = CustomerForm::getCustomerId();
        $resource = CustomerForm::where('key', $form)->where('customer_id', $customer_id)->get();
        $createAt = CustomerForm::where('key', $form)->first();
        $data = [];
        //dd($resource);
        foreach($resource as $item){
            $data[] = json_decode($item->value);
        }
        
       
        if($form == 'subscribe_tamm_model')
        {
            return view('taqneen.customer_forms.tamm.index' , compact('instance','data','createAt'));
        }
        elseif($form == 'subscribe_masarat_model')
        {
            return view('taqneen.customer_forms.masarat.index' , compact('instance','data','createAt'));
        }
        elseif($form == 'subscribe_muqeem_model')
        {
            return view('taqneen.customer_forms.muqeem.index' , compact('instance','data','createAt'));
        }
        elseif($form == 'subscribe_naba_model')
        {
            return view('taqneen.customer_forms.naba.index' , compact('instance','data','createAt'));
        }
        else
        {
            return view('taqneen.customer_forms.shomoos.index' , compact('instance','data','createAt'));
        }
    }


    public function create($form_name)
    {
        $instance = CustomerForm::class;
        return view('taqneen.customer_forms.' . $form_name, compact('instance'));
    }

    public function save(Request $request)
    {

        // $value = json_encode($request->form);
        // dd($value);
        try {
            $key = $request->customer_type;
            $value = json_encode($request->form);
            $resource = CustomerForm::createOrUpdate($key, $value);

            return $this->viewPdf($resource, $key);
        } catch (Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
 
            return back()->with('status', $output);
        } 
    }

    public function viewPdf(CustomerForm $resource, $key)
    {
        $file = $key;
        $customer_id = CustomerForm::getCustomerId();
        //$resource = CustomerForm::where('key', $key)->where('customer_id', $customer_id)->first();
        

        if (!$resource) 
            $resource = new CustomerForm();

        $data = json_decode($resource->value); 
        $html = view('taqneen.customer_forms.pdf.' . $file, compact('resource', 'data'))->render();
        

        
       return $this->getPdf1($html);
        //return view('taqneen.customer_forms.pdf.' . $file, compact('resource', 'data'));
    }


    public function getPdf1($html) {
        $stylesheet = file_get_contents('css/customer_forms.css');
        $pdf = PDF::loadHTML($html);  
        $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        return $pdf->stream('document.pdf');
    }

    public function getPdf2($html) {
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($html);
        $html2pdf->output('myPdf.pdf');
    }
}
