<?php

namespace App\Http\Controllers;

use Spatie\Analytics\Period;
use Spatie\Analytics\AnalyticsFacade as Analytics;

class DashboardController extends Controller
{
    //
    public function index(){
        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        // $analyticsData = Analytics::performQuery(
        //     Period::years(1),
        //     'ga:sessions',
        //     [
        //         'metrics' => 'ga:sessions, ga:pageviews',
        //         'dimensions' => 'ga:yearMonth'
        //     ]
        // );

        // dd($analyticsData);
        return view('administrator.dashboard', compact('analyticsData'));
    }
}
