<?php

namespace Modules\Subscription\Http\Controllers;

use App\Product;
use App\TransactionSellLine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (!auth()->user()->can('subscription.module')) {
            abort(403, 'Unauthorized action.');
        }
        return view('subscription::index');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function receiption()
    {
        if (!auth()->user()->can('subscription.receiption')) {
            abort(403, 'Unauthorized action.');
        }
        return view('subscription::receiption');
    }

    public function stopSubscription(Request $request)
    {
        try {
            $id = $request->id;
            $subscription = Subscription::activeQuery()->where('transaction_sell_lines.id', $id)->first();
            $product = Product::find($subscription->product_id);

            if ($subscription->stop_times >= $product->stop_max_times) 
                return responseJson(0, __('you skip max times of stop subscription'));

            if (request()->days > $product->stop_max_days) 
                return responseJson(0, __('you skip max days of stop subscription'));

            $now = Carbon::now()->format("Y-m-d");
            $end = Carbon::now()->addDays($request->days)->format("Y-m-d");

            $resource = TransactionSellLine::find($id);

            $resource->stop_start_date = $now;
            $resource->stop_end_date = $end;

            $resource->stop_times = $subscription->stop_times ? $subscription->stop_times + 1 : 1;
            $resource->is_stop = '1';

            $resource->update();

            return responseJson(1, __('subscription stoped to '). $end);
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
    }

    public function renewSubscription(Request $request)
    {
        try {
            $id = $request->id; 

            Subscription::renewSubscription($id);

            return responseJson(1, __('subscription renewed'));
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
    }
}
