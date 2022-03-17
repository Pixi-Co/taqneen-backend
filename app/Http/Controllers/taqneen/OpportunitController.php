<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServicePackage;

class OpportunitController extends Controller
{
    public function index(){
        $opportunities = Contact::where('type','opportunity')->where('business_id', session('business.id'))->latest()->get();
        return view('taqneen.opportunities.index',compact('opportunities'));
    }

    public function create() {
        $opportunity = new Contact();
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        $packages = ServicePackage::where('business_id', session('user.business_id'))->pluck("name", "id")->toArray(); 
        return view('taqneen.opportunities.form',compact('opportunity','services','packages'));
    }//end create


    public function edit($id){
        $opportunity = Contact::find($id);
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        $packages = ServicePackage::where('business_id', session('user.business_id'))->pluck("name", "id")->toArray();
        return view('taqneen.opportunities.form',compact('opportunity','services','packages'));

    }


    public function store(Request  $request){
        try{
            $data=[
                "name" => $request->name,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "custom_field2" => $request->custom_field2, // service ,
                "custom_field3" => $request->custom_field3, // package,
                "business_id" =>session('business.id'),
                "created_by" => session('user.id'),
                "type" => 'opportunity',
            ];
            
           Contact::create($data);

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

    public function update(Request $request,$id){
        try{
            $data=[
                "name" => $request->name,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "custom_field2" => $request->custom_field2, // service ,
                "custom_field3" => $request->custom_field3, // package,
                
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

}



