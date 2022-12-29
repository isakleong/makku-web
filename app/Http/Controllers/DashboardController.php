<?php

namespace App\Http\Controllers;

use AkkiIo\LaravelGoogleAnalytics\Facades\LaravelGoogleAnalytics;
use AkkiIo\LaravelGoogleAnalytics\Period;
use Google\Analytics\Data\V1beta\Filter\NumericFilter\Operation;
use Google\Analytics\Data\V1beta\Filter\StringFilter\MatchType;
use Google\Analytics\Data\V1beta\MetricAggregation;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    //
    public function index(){
        
        
        // dd($res);
        // dd(response()->json($res));
        // return response()->json($res);

        return view('administrator.dashboard');
    }

    public function ga4_mostViewsByPage() {
        $count = request('count');

        if (request('days') == 'today') {
            $from = Period::days(0);
        } elseif (request('days') == 'yesterday') {
            // $from = Period::create(Carbon::today()->subDays(1), Carbon::today());
            $from = Period::days(1);
        } elseif (request('days') == 'thisweek') {
            $from = Period::create(Carbon::today()->subDays(7), Carbon::today());
        } elseif (request('days') == 'thismonth') {
            // $from = Period::create(Carbon::today()->subDays(30), Carbon::today());
            $from = Period::days(30);
        } elseif (request('days') == 'thisyear') {
            // $from = Period::days(365);
            // $from = Period::years(1);
            $from = Period::create(Carbon::today()->subYear(), Carbon::today());
        } elseif (request('days') == 'lastweek') {
            $from = Period::create(Carbon::today()->subDays(14), Carbon::today()->subDays(7));
        } elseif (request('days') == 'lastmonth') {
            $from = Period::create(Carbon::today()->subMonths(2), Carbon::today()->subMonths(1));
        } elseif (request('days') == 'lastyear') {
            $from = Period::create(Carbon::today()->subYears(2), Carbon::today()->subYears(1));
        }

        // $from = (request('days', null) != null
        // && is_int(request('days', null))
        // && request('days', -1) >= 0) ? Period::days(request('days')) : Period::days(7);
        // $count = (request('count', null) != null
        // && is_int(request('count', null))
        // && request('count', -1) >= 0) ? request('count', 10) : 10;

        $res = LaravelGoogleAnalytics::getMostViewsByPage($from, $count);

        echo json_encode($res);

        // echo response()->json($res);
        // echo request('days') . " --- " . print_r($from);
    }


}
