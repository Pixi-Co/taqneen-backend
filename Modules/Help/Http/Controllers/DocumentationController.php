<?php

namespace Modules\Help\Http\Controllers;

use Modules\Help\Entities\Tutorial;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Modules\Help\Entities\UserTutorial;
use stdClass;


class DocumentationController extends Controller
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
        $categoriesResult = [];
        $categories = [];
        $cats = [];
        $articles = [];

        $catRow = DB::table('sb_settings')->where('name', 'articles-categories')->first(); 
        if ($catRow) {
            $categoriesResult = json_decode($catRow->value);

            foreach($categoriesResult as $item) {
                $cats[$item->id] = $item;
            }
        }
        $atcRow = DB::table('sb_settings')->where('name', 'articles')->first(); 
        if ($atcRow) {
            $result = json_decode($atcRow->value);
 
            foreach($result as $article) {
                if (optional($article)->business_type_id == optional(Auth::user()->business)->typeId || !optional($article)->business_type_id) {
                
                    if ($this->isContain(request()->search, $article) || !request()->search) {

                        if (optional($article)->parent_category) {
                            $categories[optional($article)->parent_category] = $cats[optional($article)->parent_category];
                            //$categories[optional($article)->parent_category]->children = [];
    
                            foreach($article->categories as $key => $cat) {
                                
                                $article->categories[$key] = $cats[$cat];
    
                                if (strlen($cat) > 0)
                                if (isset($cats[$cat]))
                                    $categories[optional($article)->parent_category]->children[] = $cats[$cat];
                            }
                        } else {
                            foreach($article->categories as $key => $cat) {
                                $article->categories[$key] = $cats[$cat];
        
                                if (isset($cats[$cat]))
                                    $categories[$cat] = $cats[$cat];
                            }
                        }
        
                        $articles[] = $article;
                    }
                }
            }
        }

        //dd($categories);
 
 
 
        return view('help::documentation.index', compact("categories", "cats", "articles"));
    }

    public function isContain($key, $article) {
        if (str_contains($article->title, $key)) {
            return true;
        }

        if (str_contains($article->content, $key)) {
            return true;
        }

        return false;
    }

 
}
