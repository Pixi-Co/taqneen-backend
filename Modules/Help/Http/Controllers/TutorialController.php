<?php

namespace Modules\Help\Http\Controllers;

use Modules\Help\Entities\Tutorial;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Modules\Help\Entities\UserTutorial;

class TutorialController extends Controller
{

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct()
    { 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (!auth()->user()->can('tutorial.view') && !auth()->user()->can('tutorial.create')) {
        //    abort(403, 'Unauthorized action.');
        //}

        if (request()->ajax() && request()->content_type != 'html') { 

            $tutorial = Tutorial::query();

            return Datatables::of($tutorial)
                ->addColumn(
                    'action',
                    ' 
                    <button data-href="{{action(\'\Modules\Help\Http\Controllers\TutorialController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_tutorial_button"><i class="glyphicon glyphicon-edit"></i> @trans("messages.edit")</button>
                        &nbsp; 
                    <button data-href="{{action(\'\Modules\Help\Http\Controllers\TutorialController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_tutorial_button" ><i class="glyphicon glyphicon-trash"></i> @trans("messages.delete")</button>
                    '
                )    
                ->rawColumns(['action', 'active'])
                ->make(true);
        }

        return view('help::tutorial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load(Tutorial $tutorial)
    {
        Tutorial::setCurrentTutorial($tutorial->id); 
        return view('help::tutorial.load', compact('tutorial'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setCurrent(Tutorial $tutorial)
    {
        Tutorial::setCurrentTutorial($tutorial->id);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function endTutorial()
    {
        Tutorial::endTutorial();
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!auth()->user()->can('tutorial.create')) {
            abort(403, 'Unauthorized action.');
        }*/
 

        $quick_add = false;
        if (!empty(request()->input('quick_add'))) {
            $quick_add = true;
        }
 
        return view('help::tutorial.create')
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
        /*if (!auth()->user()->can('tutorial.create')) {
            abort(403, 'Unauthorized action.');
        }*/

        try {
            $input = $request->all();  
            
            // upload image
            if ($request->hasFile('image')) {
                $filename = uploadImg($request->file('image'), "uploads/tutorial/", function($filename){}); 
                $input['image'] = "/uploads/tutorial/" . $filename;   
            }
            
            // upload video
            if ($request->hasFile('video')) {
                $filename = uploadImg($request->file('video'), "uploads/tutorial/", function($filename){}); 
                $input['video'] = "/uploads/tutorial/" . $filename;   
            }


            $tutorial = Tutorial::create($input); 
            return responseJson(1, __("tutorial.added_success"), $tutorial); 
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
        /*if (!auth()->user()->can('tutorial.update')) {
            abort(403, 'Unauthorized action.');
        }*/

        $tutorial = Tutorial::find($id);
 
        return view('help::tutorial.edit')
            ->with(compact('tutorial'));
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
        if (!auth()->user()->can('tutorial.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $input = $request->all(); 

                $tutorial = Tutorial::findOrFail($id); 
                
            
                // upload image
                if ($request->hasFile('image')) {
                    $filename = uploadImg($request->file('image'), "uploads/tutorial/", function($filename){}, $tutorial->image); 
                    $input['image'] = "/uploads/tutorial/" . $filename;    
                }
                
                // upload video
                if ($request->hasFile('video')) {
                    $filename = uploadImg($request->file('video'), "uploads/tutorial/", function($filename){}, $tutorial->video); 
                    $input['video'] = "/uploads/tutorial/" . $filename;   
                }

                $tutorial->update($input);

                $output = ['status' => 1,
                            'message' => __("brand.updated_success")
                            ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
                $output = ['status' => 0,
                            'message' => $e->getMessage()
                        ];
            }

            return $output;
        }
    }

    public function complete(Tutorial $tutorial) {
        if (request()->is_done == 1) {
            UserTutorial::create([
                "user_id" => auth()->user()->id,
                "tutorial_id" => $tutorial->id,
                "is_done" => '1',
            ]);
        } else {
            UserTutorial::where('user_id', auth()->user()->id)
            ->where('tutorial_id', $tutorial->id)
            ->delete();
        }

        return responseJson(1, __("done"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (!auth()->user()->can('tutorial.delete')) {
            abort(403, 'Unauthorized action.');
        }*/

        if (request()->ajax()) {
            try { 
                $exists = Tutorial::findOrFail($id);
 
                if ($exists) {
                    $exists->delete();

                    $output = ['success' => true,
                            'msg' => __("brand.deleted_success")
                            ];
                } else {
                    $output = ['success' => false,
                            'msg' => __("lang_v1.tutorial_cannot_be_deleted")
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
