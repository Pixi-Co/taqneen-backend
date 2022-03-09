<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaxRate;
use Illuminate\Support\Facades\DB;

class TaxsController extends Controller
{
    public function index() {
        $taxs = TaxRate::where('business_id', session('user.business_id'))->latest()->get();
        return view('taqneen.taxs.index',compact('taxs'));
    }

 
    public function create() {
        $tax = new TaxRate();
        return view('taqneen.taxs.form',compact('tax'));
    }//end create


    public function edit($id){
        $tax = TaxRate::find($id);
        return view('taqneen.taxs.form', compact('tax'));
    }//end edit


    public function store(Request $request) {
        try{
            $date=[
                "name"=> $request->name,
                "amount"=> $request->amount,
                "business_id" =>session('business.id'),
                "created_by" => session('user.id'),
            ];
           
            TaxRate::create($date);  
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
        return back()->with('status', $output); 
    }//end store

    public function update(Request $request, $id) {
        try{
            $date=[
                "name" => $request->name,
                "amount" => $request->amount,
                "business_id" =>session('business.id'),
                "created_by" => session('user.id'),
            ];
            
            DB::table('tax_rates')->where('id',$id)->update($date);

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
        return redirect('/taxs')->with('status', $output);
    }//end update

    public function destroy($id) {
        try { 
            DB::table('tax_rates')->where("id", $id)->delete();

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
