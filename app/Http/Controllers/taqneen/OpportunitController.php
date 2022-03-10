<?php

namespace App\Http\Controllers\taqneen;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpportunitController extends Controller
{
    public function index(){

        $opportunities = Contact::where('type','opportunity')->where('business_id', session('business.id'))->latest()->get();
        return view('taqneen.opportunities.index',compact('opportunities'));
    }

    public function create() {
        $opportunity = new Contact();
        return view('taqneen.opportunities.form',compact('opportunity'));
    }//end create


    public function edit($id){
        $opportunity = Contact::find($id);
        return view('taqneen.opportunities.form',compact('opportunity'));

    }


    public function store(Request  $request){
        try{
            $data=[
                "name" => $request->name,
                "mobile" => $request->mobile,
                "email" => $request->email,
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



