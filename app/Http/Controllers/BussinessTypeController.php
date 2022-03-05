<?php

namespace App\Http\Controllers;

use App\BusinessType;
use App\Product;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Utils\Util;
use DB;
use Modules\Superadmin\Entities\Package;

class BussinessTypeController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (!auth()->user()->can('bussinesstype.view') && !auth()->user()->can('bussinesstype.create')) {
        //    abort(403, 'Unauthorized action.');
        //}

        if (request()->ajax() && request()->content_type != 'html') { 

            $bussinesstype = BusinessType::query();

            return Datatables::of($bussinesstype)
                ->addColumn(
                    'action',
                    '
                    <div style=\'width: 330px\' >
                    <!--
                    <a target="_blank" href="{{action(\'BussinessTypeController@permission\', [$id])}}" class="btn btn-xs w3-deep-orange"><i class="fa fa-cogs"></i> @trans("edit permissions")</a>
                        -->&nbsp; 
                    <button data-href="{{action(\'BussinessTypeController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_bussinesstype_button"><i class="glyphicon glyphicon-edit"></i> @trans("messages.edit")</button>
                        &nbsp; 
                    <button data-href="{{action(\'BussinessTypeController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_bussinesstype_button" ><i class="glyphicon glyphicon-trash"></i> @trans("messages.delete")</button>
                    </div>'
                )   
                ->editColumn('active', function(BusinessType $bussinesstype){
                    return $bussinesstype->active == 1? '<i class="fas fa fa-check-square w3-text-green" ></i>' :  '<i class="fa fa-window-close w3-text-red" ></i>' ;
                }) 
                ->rawColumns(['action', 'active'])
                ->make(true);
        }

        return view('bussinesstype.index');
    }

    public function get() {
        return BusinessType::active();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!auth()->user()->can('bussinesstype.create')) {
            abort(403, 'Unauthorized action.');
        }*/
 

        $quick_add = false;
        if (!empty(request()->input('quick_add'))) {
            $quick_add = true;
        }
 
        return view('bussinesstype.create')
                ->with(compact('quick_add'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*if (!auth()->user()->can('bussinesstype.create')) {
            abort(403, 'Unauthorized action.');
        }*/

        try {
            $input = $request->all();  
            $bussinesstype = BusinessType::create($input); 
            return responseJson(1, __("bussinesstype.added_success"), $bussinesstype); 
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
             
            return responseJson(0, $e->getMessage()); 
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permission(BusinessType $resource)
    {
        return view('bussinesstype.permission', compact('resource'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function packagePermission(Package $resource)
    {
        return view('bussinesstype.permission', compact('resource'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(BusinessType $resource, Request $request)
    {
        
        $data = $request->all();

        // delete old permissions
        $resource->getPermissions()->delete();

        // delete old chart of account
        $resource->chartAccounts()->delete();
 
        foreach($data as $key => $value) { 

            if (Str::contains($key, 'permission')) {
                $id = str_replace("permission_", "", $key);
                // insert new permisssions
                if (isset($data["permission_" . $id])) { 
                    if ($data["permission_" . $id] == 1)
                    DB::table('package_has_permissions')->insert([
                        "business_type_id" => $resource->id,
                        "permission_id" => $id,
                    ]);
                }
            } else if (Str::contains($key, 'chart_account')) {
                $id = str_replace("chart_account_", "", $key);
                // insert new chart_account
                if (isset($data["chart_account_" . $id])) { 
                    if ($data["chart_account_" . $id] == 1)
                    DB::table('chart_account_business_type')->insert([
                        "business_type_id" => $resource->id,
                        "chart_account_id" => $id,
                    ]);
                }
            }
        }
 
        return responseJson(1, __('done'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePackagePermission(Package $resource, Request $request)
    {
        
        $data = $request->all();

        // delete old permissions
        $resource->getPermissions()->delete();

        // delete old chart of account
        $resource->chartAccounts()->delete();
 
        foreach($data as $key => $value) { 

            if (Str::contains($key, 'permission')) {
                $id = str_replace("permission_", "", $key);
                // insert new permisssions
                if (isset($data["permission_" . $id])) { 
                    if ($data["permission_" . $id] == 1)
                    DB::table('package_has_permissions')->insert([
                        "package_id" => $resource->id,
                        "permission_id" => $id,
                    ]);
                }
            } else if (Str::contains($key, 'chart_account')) {
                $id = str_replace("chart_account_", "", $key);
                // insert new chart_account
                if (isset($data["chart_account_" . $id])) { 
                    if ($data["chart_account_" . $id] == 1)
                    DB::table('chart_account_packages')->insert([
                        "package_id" => $resource->id,
                        "chart_account_id" => $id,
                    ]);
                }
            }
        }
 
        return responseJson(1, __('done'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*if (!auth()->user()->can('bussinesstype.update')) {
            abort(403, 'Unauthorized action.');
        }*/

        $bussinesstype = BusinessType::find($id);
 
        return view('bussinesstype.edit')
            ->with(compact('bussinesstype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('bussinesstype.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $input = $request->all(); 

                $bussinesstype = BusinessType::findOrFail($id);
                $bussinesstype->name = $input['name'];
                $bussinesstype->slug = $input['name'];
                $bussinesstype->description = $input['description'];
                $bussinesstype->icon = $input['icon'];
                $bussinesstype->active = isset($input['active'])? 1 : 0; 
                 

                $bussinesstype->save();

                $output = ['success' => true,
                            'msg' => __("brand.updated_success")
                            ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
                $output = ['success' => false,
                            'msg' => $e->getMessage()
                        ];
            }

            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (!auth()->user()->can('bussinesstype.delete')) {
            abort(403, 'Unauthorized action.');
        }*/

        if (request()->ajax()) {
            try { 
                $exists = BusinessType::findOrFail($id);
 
                if ($exists) {
                    $exists->delete();

                    $output = ['success' => true,
                            'msg' => __("brand.deleted_success")
                            ];
                } else {
                    $output = ['success' => false,
                            'msg' => __("lang_v1.bussinesstype_cannot_be_deleted")
                            ];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
                $output = ['success' => false,
                            'msg' => '__("messages.something_went_wrong")'
                        ];
            }

            return $output;
        }
    }
}
