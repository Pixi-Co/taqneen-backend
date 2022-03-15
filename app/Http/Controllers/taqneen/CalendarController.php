<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{

    public function index() {
        $services = Category::where('business_id', session('business.id'))->where('category_type', 'service')->get();
        return view('taqneen.calendar.index', compact('services'));
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get()
    {
        $business_id = request()->session()->get('user.business_id');
        $events = [];

        $query = Subscription::select(
            '*',
            DB::raw('(select first_name from contacts where contacts.id = contact_id) as contact_name')
        )
            ->where('business_id', $business_id) 
            ->where('is_expire', '1');


        if (request()->service_id > 0) { 
            $ids = DB::table('subscription_lines')
                ->where('service_id', request()->service_id)
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("id", $ids);
        } 
/*
        if (request()->trainer_id > 0)
            $resources->where('trainer_id', request()->trainer_id);

        $resources->whereIn('class_type_id', request()->events);
*/


        $resources = $query->get();

        foreach ($resources as $resource) {
            //dd($resource->getDatesFromSession()); 

            $events[] = [
                'title' => optional($resource->contact)->name . " (" .  $resource->service_names . ")",
                'title_html' => optional($resource->contact)->name . " (" .  $resource->service_names . ")",
                'start' => $resource['transaction_date'],
                'end' => $resource['transaction_date'],
                'customer_name' =>  optional($resource->contact)->name . " (" .  $resource->service_names . ")",
                'table' => "table",
                'url' => "/subscriptions",
                'event_url' => "#",
                'backgroundColor' => "#ef4747",
                'borderColor'     => "#41bc85",
                'allDay'          => false,
                'event_type' => 1
            ];
        }

        return $events;
    }
}
