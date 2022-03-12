<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use DB;

class ServiceController extends Controller
{

    public function index() {
        $services = Category::where('business_id', session('user.business_id'))->where('category_type', 'service')->get(); 
        return view('taqneen.services.index', compact("services"));
    }


    public function create() {
        $service = new Category();
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        return view('taqneen.services.form', compact("service", "services"));
    }
     
    public function edit($id) {
        $service = Category::find($id);
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        return view('taqneen.services.form', compact("service", "services"));
    }
    
    public function store(Request $request) {
        try {
            $data = [
                "name" => $request->name,
                "description" => $request->description,
                "parent_id" => $request->parent_id? $request->parent_id : '0',
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "category_type" => "service",
            ];
    
            Category::create($data);

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        return back()->with('status', $output); 
    }
    
    public function update(Request $request, $id) {
        try {
            $data = [
                "name" => $request->name,
                "description" => $request->description,
                "parent_id" => $request->parent_id? $request->parent_id : '0',
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "category_type" => "service",
            ];
    
            $category = Category::find($id);
            $category->update($data);

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        return redirect('/services')->with('status', $output); 
    }

    
    
    public function destroy($id) {
        try { 
            $category = Category::find($id);
            $category->delete();

            $output = [
                "success" => 1,
                "msg" => @trans('delete successfull')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }

        return $output;
        return back()->with('status', $output); 
    }
}
