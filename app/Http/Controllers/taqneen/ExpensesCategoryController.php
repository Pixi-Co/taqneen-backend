<?php

namespace App\Http\Controllers\taqneen;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpensesCategoryController extends Controller
{
    public function index() {
        $categories = ExpenseCategory::where('business_id', session('user.business_id'))->latest()->get();
        return view('taqneen.categories.index',compact('categories'));
    }


    public function create() {
        $category = new ExpenseCategory();
        return view('taqneen.categories.form',compact('category'));
    }//end create


    public function edit($id){
        $category = ExpenseCategory::find($id);
        return view('taqneen.categories.form', compact("category"));
    }//end edit


    public function store(Request $request) {
        try{
            $date=[
                "name" => $request->name,
                "price" => $request->price,
                "business_id" =>session('business.id'),
            ];
            
           ExpenseCategory::create($date);

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
        //dd($output);
        return back()->with('status', $output); 
    }//end store

    public function update(Request $request, $id) {
        try{
            $date=[
                "name" => $request->name,
                "price" => $request->price,
                "business_id" =>session('business.id'),
            ];
            
            DB::table('expense_categories')->where('id',$id)->update($date);

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
        return redirect('/categories')->with('status', $output);
    }//end update

    public function destroy($id) {
        try { 
           ExpenseCategory::find($id)->delete();

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

     return  $output; 
    }// end destroy

}
