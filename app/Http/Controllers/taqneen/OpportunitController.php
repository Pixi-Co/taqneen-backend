<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\OpportunitImport;
use App\ServicePackage;
use App\Triger;
use App\User;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class OpportunitController extends Controller
{
    public function index(){
        $status = [
            "new" => __('new'), 
            "follow" => __('follow'), 
            "no_need" => __('no_need'), 
            "no_reach" => __('no_reach'), 
            "done" => __('done'), 
            "another_provider" => __('another_provider'), 
        ];
        $users = User::forDropdown(session('business.id'));
        $query = Contact::where('type','opportunity')->where('business_id', session('business.id'))
        ->latest();

        if (!auth()->user()->isAdmin()) {
            $query->where('converted_by', auth()->user()->id);
        }

        if (request()->publish_date_start && request()->publish_date_end) {
            $query->whereBetween('dob', [request()->publish_date_start, request()->publish_date_end]);
        }
        if(request()->created_by){
            $query->where('created_by',request()->created_by)->get();
        }
        if(request()->custom_field4){
            $query->where('custom_field4',request()->custom_field4)->get();
        }
        $opportunities = $query->get();

        return view('taqneen.opportunities.index',compact('opportunities','users','status'));
    }

    public function create() {
        $status = [
            "new" => __('new'), 
            "follow" => __('follow'), 
            "no_need" => __('no_need'), 
            "no_reach" => __('no_reach'), 
            "done" => __('done'), 
            "another_provider" => __('another_provider'),
        ];
        
        $opportunity = new Contact();
        $disabled = "";
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        $packages = ServicePackage::where('business_id', session('user.business_id'))->pluck("name", "id")->toArray(); 
        $users = User::forDropdown(session('business.id'));
        $packageResources = ServicePackage::where('business_id', session('user.business_id'))->get();
        return view('taqneen.opportunities.form',compact('packageResources', 'opportunity','services','packages', 'users','status', 'disabled'));
    }//end create


    public function edit($id){
        //new - follow - no need - no-reach - done - anpther provider
        $status = [
            "new" => __('new'), 
            "follow" => __('follow'), 
            "no_need" => __('no_need'), 
            "no_reach" => __('no_reach'), 
            "done" => __('done'), 
            "another_provider" => __('another_provider'), 
        ];
        $opportunity = Contact::find($id);
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        $packages = ServicePackage::where('business_id', session('user.business_id'))->pluck("name", "id")->toArray();
        $users = User::forDropdown(session('business.id'));
        $disabled = auth()->user()->isAdmin()? "" : "disabled";
        $packageResources = ServicePackage::where('business_id', session('user.business_id'))->get();
        return view('taqneen.opportunities.form',compact('packageResources', 'opportunity','services','packages', 'users','status', 'disabled'));

    }


    public function store(Request  $request){
        $contact = null;
        try{
            $data=[
                "name" => $request->name,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "dob" => $request->dob,
                "custom_field2" => $request->custom_field2, // service ,
                "custom_field3" => $request->custom_field3, // package,
                "custom_field4" => $request->custom_field4, // status,
                "business_id" =>session('business.id'),
                "created_by" => $request->created_by,
                "type" => 'opportunity',
            ];
            
           $contact = Contact::create($data);

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];

        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        // dd($output); 
        Triger::fire2(Triger::$ADD_OPPORTUNITY, $contact);

        return back()->with('status', $output); 

    }

    public function update(Request $request,$id){
        try{
            $data=[
                "name" => $request->name,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "dob" => $request->dob,
                "custom_field2" => $request->custom_field2, // service ,
                "custom_field3" => $request->custom_field3, // package,
                "custom_field4" => $request->custom_field4, // status,
                //"created_by" => $request->created_by,
            ];
            
           Contact::find($id)->update($request->all());

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];

        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        // dd($output);
        return back()->with('status', $output); 
    }

    public function destroy($id) {
        try { 
            $opportunity = Contact::find($id);
            $opportunity->delete();
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
    }// end destroy

    public function takeOppotunity($id){
       
        try{
            $data=[
                "converted_by"=> session('user.id')
                
            ];
            
           Contact::find($id)->update($data);

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];

        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        // dd($output);
        return back()->with('status', $output); 
    }

    public function opportunitDownload()
    {
        $files = Storage::disk('public_uploads_files')->getAdapter()->applyPathPrefix('import_opportunit_template.xlsx');
        return  response()->download($files);
    }

    public function opportunitImportFile(Request $request){
        
       
        //return redirect('/customers');  

        try { 
            if ($request->hasFile('import_file')) {
                $import_file = $request->file('import_file');
            }
            Excel::import(new OpportunitImport, $import_file);

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }

         return back()->with('status', $output); ; 
    }

}



