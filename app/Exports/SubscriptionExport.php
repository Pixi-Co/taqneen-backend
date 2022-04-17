<?php

namespace App\Exports;

use App\Http\Controllers\taqneen\SubscriptionController;
use App\Subscription;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SubscriptionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $query = (new SubscriptionController())->getQuery();
        $resources = $query->get();
        return view("taqneen.subscription.export", compact("resources"));
    }
}
