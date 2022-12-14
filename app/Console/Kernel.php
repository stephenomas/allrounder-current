<?php

namespace App\Console;

use App\Models\Sales;
use App\Models\Branch;
use App\Mail\SalesReport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
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
     $schedule->call(function(){
        $now  = \Carbon\Carbon::today()->toDate();
        $nowstring = \Carbon\Carbon::today()->toDateString();
        $branches = Branch::all();
        $reports = [];

        foreach($branches as $branch){
            $todaym = 0;
            $todayt = 0;
            $today_ckd_m = 0;
            $today_ckd_t = 0;
            $amount = 0;
            $sale_cbu = 0;
            $sale_ckdm = 0;
            $sale_ckdt = 0;
            $sale = Sales::whereHas('user', function(Builder $query) use($branch){
                $query->where('branch_id', $branch->id);
            })
            ->where('paymentstatus', 'Paid')
            ->orWhere('paymentstatus', 'Pending')->get();
            foreach($sale as $sales){
                $saled = \Carbon\Carbon::parse($sales->created_at)->toDate();
                if($saled >= $now  ){
                    $sale_cbu = $sale_cbu + $sales->price;
                    foreach($sales->salesitem as $item){
                        if(isset($item->product)){
                            if($item->product->type == 'Motorcycle'){
                                $todaym = $todaym + 1;
                            }elseif($item->product->type == 'Tricycle'){
                                $todayt = $todayt + 1;
                            }
                        }
                    }

                }
            }

            $ckdsoldm = Sales::where('ckd_type', 'like', '%motor%')->whereHas('user', function(Builder $query) use($branch){
                $query->where('branch_id', $branch->id);
            })->get();
            $ckdsoldt = Sales::where('ckd_type', 'like', '%tric%')->whereHas('user', function(Builder $query) use($branch){
                $query->where('branch_id', $branch->id);
            })->get();

            foreach($ckdsoldm as $m){
                $sell = \Carbon\Carbon::parse($m->created_at)->toDate();
                if($sell >= $now){
                    $sale_ckdm = $sale_ckdm + $m->price;
                    $today_ckd_m = $today_ckd_m + $m->unit;
                }
            }

            foreach($ckdsoldt as $t){
                $sell = \Carbon\Carbon::parse($t->created_at)->toDate();
                if($sell >= $now){
                    $sale_ckdt = $sale_ckdt + $t->price;
                    $today_ckd_t = $today_ckd_t + $t->unit;
                }
            }
            $todaym = $todaym + $today_ckd_m;
            $todayt = $todayt + $today_ckd_t;

            $amount = $sale_cbu + $sale_ckdm + $sale_ckdt;

            $reports = array_merge($reports, [[
                "branch" => $branch->name,
                "motorcycles" => $todaym,
                "tricycles" => $todayt,
                "amount" => $amount,
                "date" => $nowstring
            ]]);
        }

        Mail::to('fewgenesis@gmail.com')->send(new SalesReport($reports));
     })->dailyAt('10:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
