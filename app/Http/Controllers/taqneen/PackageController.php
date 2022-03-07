<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\ServicePackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use DB;

class PackageController extends Controller
{

    public function index() {
        $packages = ServicePackage::where('business_id', session('user.business_id'))->get(); 
        return view('taqneen.packages.index', compact("packages"));
    }


    public function create() {
        $package = new ServicePackage();
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        $types = [
            "include" => trans('include'),
            "process" => trans('process'),
        ];
        $interval_types = [
            "day" => trans('day'),
            "month" => trans('month'),
            "year" => trans('year'),
        ];
        return view('taqneen.packages.form', compact("package", "services", "types", "interval_types"));
    }
    
    public function edit($id) {
        $package = ServicePackage::find($id); 
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        $types = [
            "include" => trans('include'),
            "process" => trans('process'),
        ];
        $interval_types = [
            "day" => trans('day'),
            "month" => trans('month'),
            "year" => trans('year'),
        ];
        return view('taqneen.packages.form', compact("package", "services", "types", "interval_types"));
    }
    
    public function store(Request $request) {
        try {
            $data = [
                "name" => $request->name,
                "description" => $request->description, 
                "type" => $request->type, 
                "price" => $request->price, 
                "interval_type" => $request->interval_type, 
                "interval_number" => $request->interval_number, 
                "service_id" => $request->service_id, 
                "from" => $request->from, 
                "to" => $request->to, 
                "business_id" => session('business.id'), 
            ];
 
    
            DB::table('taqneen_package')->insert($data);

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
                "type" => $request->type, 
                "price" => $request->price, 
                "interval_type" => $request->interval_type, 
                "interval_number" => $request->interval_number, 
                "service_id" => $request->service_id, 
                "from" => $request->from, 
                "to" => $request->to, 
                "business_id" => session('business.id'), 
            ];
    
            DB::table('taqneen_package')->where("id", $id)->update($data);

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
        return redirect('/packages')->with('status', $output); 
    }

    
    
    public function destroy($id) {
        try { 
            DB::table('taqneen_package')->where("id", $id)->delete();

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
    }
}
