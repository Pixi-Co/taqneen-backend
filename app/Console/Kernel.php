<?php

namespace App\Console;

use App\Subscription;
use App\Transaction;
use App\Triger;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $env = config('app.env');
        $email = config('mail.username');

        if ($env === 'live') {
            //Scheduling backup, specify the time when the backup will get cleaned & time when it will run.
            $schedule->command('backup:run')->dailyAt('23:50');

            //Schedule to create recurring invoices
            $schedule->command('pos:generateSubscriptionInvoices')->dailyAt('23:30');
            $schedule->command('pos:updateRewardPoints')->dailyAt('23:45');
        }

        if ($env === 'demo' && !empty($email)) {
            //IMPORTANT NOTE: This command will delete all business details and create dummy business, run only in demo server.
            $schedule->command('pos:dummyBusiness')
                    ->cron('0 */3 * * *')
                    //->everyThirtyMinutes()
                    ->emailOutputTo($email);
        }

        // run schedule every day
        $schedule->call(function () {
            $transactions = Subscription::all();

        foreach($transactions as $item) { 
            $today = Carbon::now();
            $date = Carbon::parse(strtotime($item->expire_date));
            $diffInWeeks = $today->diffInWeeks($date);
            $isBefore = false;

            if (strtotime(date('Y-m-d')) > strtotime($item->expire_date)) {
                $isBefore = false;
            } else {
                $isBefore = true;
            }

            // today expire triger
            
            if (strtotime(date('Y-m-d')) == strtotime($item->expire_date)) {
                Triger::fire(Triger::$EXPIRE_SUBSCRIPTION_DAY, $item->id);
            }

            if ($diffInWeeks == 1) {
                $isBefore? 
                Triger::fire(Triger::$EXPIRE_SUBSCRIPTION_BEFORE_1_WEEKS, $item->id) : 
                Triger::fire(Triger::$EXPIRE_SUBSCRIPTION_AFTER_1_WEEKS, $item->id);
            } else if ($diffInWeeks == 2) {
                $isBefore? 
                Triger::fire(Triger::$EXPIRE_SUBSCRIPTION_BEFORE_2_WEEKS, $item->id) : 
                Triger::fire(Triger::$EXPIRE_SUBSCRIPTION_AFTER_2_WEEKS, $item->id);
            } else if ($diffInWeeks == 3) {
                $isBefore? 
                Triger::fire(Triger::$EXPIRE_SUBSCRIPTION_BEFORE_3_WEEKS, $item->id) : 
                Triger::fire(Triger::$EXPIRE_SUBSCRIPTION_AFTER_3_WEEKS, $item->id);
            } 
        }
        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
