<?php

namespace App\Http\Controllers;

use App\Language; 

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

use App\Utils\Util;

class LanguageController extends Controller
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
        //if (!auth()->user()->can('language.view') && !auth()->user()->can('language.create')) {
        //    abort(403, 'Unauthorized action.');
        //}

        if (request()->ajax() && request()->content_type != 'html') { 

            $language = Language::query();

            return Datatables::of($language)
                ->addColumn(
                    'action',
                    '<div style="width: 200px" >
                    <button data-href="{{action(\'LanguageController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_language_button"><i class="glyphicon glyphicon-edit"></i> @trans("messages.edit")</button>
                        &nbsp; 
                    <button data-href="{{action(\'LanguageController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_language_button" ><i class="glyphicon glyphicon-trash"></i> @trans("messages.delete")</button>
                    </div>'
                )   
                ->editColumn('active', function(Language $language){
                    return $language->active == 1? '<i class="fas fa fa-check-square w3-text-green" ></i>' :  '<i class="fa fa-window-close w3-text-red" ></i>' ;
                }) 
                ->editColumn('is_rtl', function(Language $language){
                    return $language->is_rtl == 1? '<i class="fas fa fa-check-square w3-text-green" ></i>' :  '<i class="fa fa-window-close w3-text-red" ></i>' ;
                })
                ->rawColumns(['action', 'active', 'is_rtl'])
                ->make(true);
        }

        return view('language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!auth()->user()->can('language.create')) {
            abort(403, 'Unauthorized action.');
        }*/
 

        $quick_add = false;
        if (!empty(request()->input('quick_add'))) {
            $quick_add = true;
        }
 
        return view('language.create')
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
        /*if (!auth()->user()->can('language.create')) {
            abort(403, 'Unauthorized action.');
        }*/

        try {
            $input = $request->all();  
            $language = Language::create($input); 
            return responseJson(1, __("language.added_success"), $language); 
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*if (!auth()->user()->can('language.update')) {
            abort(403, 'Unauthorized action.');
        }*/

        $language = Language::find($id);
 
        return view('language.edit')
            ->with(compact('language'));
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
        if (!auth()->user()->can('language.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try { 
                $language = Language::findOrFail($id);  
                 

                $language->update($request->all());

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
        /*if (!auth()->user()->can('language.delete')) {
            abort(403, 'Unauthorized action.');
        }*/

        if (request()->ajax()) {
            try { 
                $exists = Language::findOrFail($id);
 
                if ($exists) {
                    $exists->delete();

                    $output = ['success' => true,
                            'msg' => __("brand.deleted_success")
                            ];
                } else {
                    $output = ['success' => false,
                            'msg' => __("lang_v1.language_cannot_be_deleted")
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
