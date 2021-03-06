<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{

    public function index()
    {
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
            ->where('business_id', $business_id);

        if (auth()->user()->can(find_or_create_p('subscriptions.own_data', 'subscriptions'))) {
            $query->onlyMe();
        }

        if (request()->service_id > 0) {
            $ids = DB::table('subscription_lines')
                ->where('service_id', request()->service_id)
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("id", $ids);
        }

        if (request()->subscription_type) {
            if (request()->subscription_type == 'new') {
                $query->where('is_renew', '0');
            } else {
                $query->where('is_renew', '1');
            }
        }


        $resources = $query->get();

        foreach ($resources as $resource) {

            $view = optional($resource->contact)->name .
                " " . $resource->expire_date . " " .
                " (" .  $resource->service_names . ")";

            $status = $resource->getExpireStatusForCalendar();

            $events[] = [
                'title' => $view,
                'title_html' => $view,
                'start' => $resource->expire_date,
                'end' => $resource->expire_date,
                'customer_name' =>  $view,
                'table' => "table",
                'url' => "/subscriptions/" . $resource->id . "/edit",
                'event_url' => "/subscriptions/" . $resource->id . "/edit",
                'backgroundColor' => $status[1],
                'borderColor'     => "#41bc85",
                'allDay'          => false,
                'event_type' => $status[0]
            ];
        }

        return $events;
    }
}
