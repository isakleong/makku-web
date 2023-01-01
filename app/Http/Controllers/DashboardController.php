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
    public function index(){
        return view('administrator.dashboard');
    }

    public function ga4_totalViews() {
        if (request('days') == 'today') {
            $from = Period::days(0);
        } elseif (request('days') == 'yesterday') {
            $from = Period::days(1);
        } elseif (request('days') == 'thisweek') {
            $from = Period::create(Carbon::today()->subDays(7), Carbon::today());
        } elseif (request('days') == 'thismonth') {
            $from = Period::days(30);
        } elseif (request('days') == 'thisyear') {
            $from = Period::create(Carbon::today()->subYear(), Carbon::today());
        } elseif (request('days') == 'lastweek') {
            $from = Period::create(Carbon::today()->subDays(14), Carbon::today()->subDays(7));
        } elseif (request('days') == 'lastmonth') {
            $from = Period::create(Carbon::today()->subMonths(2), Carbon::today()->subMonths(1));
        } elseif (request('days') == 'lastyear') {
            $from = Period::create(Carbon::today()->subYears(2), Carbon::today()->subYears(1));
        }

        $res = LaravelGoogleAnalytics::getTotalViews($from);

        echo json_encode($res);
    }

    public function ga4_totalUsers() {
        if (request('days') == 'today') {
            $from = Period::days(0);
        } elseif (request('days') == 'yesterday') {
            $from = Period::days(1);
        } elseif (request('days') == 'thisweek') {
            $from = Period::create(Carbon::today()->subDays(7), Carbon::today());
        } elseif (request('days') == 'thismonth') {
            $from = Period::days(30);
        } elseif (request('days') == 'thisyear') {
            $from = Period::create(Carbon::today()->subYear(), Carbon::today());
        } elseif (request('days') == 'lastweek') {
            $from = Period::create(Carbon::today()->subDays(14), Carbon::today()->subDays(7));
        } elseif (request('days') == 'lastmonth') {
            $from = Period::create(Carbon::today()->subMonths(2), Carbon::today()->subMonths(1));
        } elseif (request('days') == 'lastyear') {
            $from = Period::create(Carbon::today()->subYears(2), Carbon::today()->subYears(1));
        }

        $res = LaravelGoogleAnalytics::getTotalUsers($from);

        echo json_encode($res);
    }

    public function ga4_totalNewAndReturningUsers() {
        if (request('days') == 'today') {
            $from = Period::days(0);
        } elseif (request('days') == 'yesterday') {
            $from = Period::days(1);
        } elseif (request('days') == 'thisweek') {
            $from = Period::create(Carbon::today()->subDays(7), Carbon::today());
        } elseif (request('days') == 'thismonth') {
            $from = Period::days(30);
        } elseif (request('days') == 'thisyear') {
            $from = Period::create(Carbon::today()->subYear(), Carbon::today());
        } elseif (request('days') == 'lastweek') {
            $from = Period::create(Carbon::today()->subDays(14), Carbon::today()->subDays(7));
        } elseif (request('days') == 'lastmonth') {
            $from = Period::create(Carbon::today()->subMonths(2), Carbon::today()->subMonths(1));
        } elseif (request('days') == 'lastyear') {
            $from = Period::create(Carbon::today()->subYears(2), Carbon::today()->subYears(1));
        }

        $res = LaravelGoogleAnalytics::getTotalNewAndReturningUsers($from);

        echo json_encode($res);
    }

    public function ga4_averageSessionDuration() {
        if (request('days') == 'today') {
            $from = Period::days(0);
        } elseif (request('days') == 'yesterday') {
            $from = Period::days(1);
        } elseif (request('days') == 'thisweek') {
            $from = Period::create(Carbon::today()->subDays(7), Carbon::today());
        } elseif (request('days') == 'thismonth') {
            $from = Period::days(30);
        } elseif (request('days') == 'thisyear') {
            $from = Period::create(Carbon::today()->subYear(), Carbon::today());
        } elseif (request('days') == 'lastweek') {
            $from = Period::create(Carbon::today()->subDays(14), Carbon::today()->subDays(7));
        } elseif (request('days') == 'lastmonth') {
            $from = Period::create(Carbon::today()->subMonths(2), Carbon::today()->subMonths(1));
        } elseif (request('days') == 'lastyear') {
            $from = Period::create(Carbon::today()->subYears(2), Carbon::today()->subYears(1));
        }

        $res = LaravelGoogleAnalytics::getAverageSessionDuration($from);

        echo json_encode($res);
    }

    public function ga4_mostViewsByPage() {
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

        $res = LaravelGoogleAnalytics::getMostViewsByPage($from, request('count'));

        echo json_encode($res);
        // echo response()->json($res);
    }

    public function ga4_totalUsersByDate() {
        if (request('days') == 'today') {
            $from = Period::days(0);
        } elseif (request('days') == 'yesterday') {
            $from = Period::days(1);
        } elseif (request('days') == 'thisweek') {
            $from = Period::create(Carbon::today()->subDays(7), Carbon::today());
        } elseif (request('days') == 'thismonth') {
            $from = Period::days(30);
        } elseif (request('days') == 'thisyear') {
            $from = Period::create(Carbon::today()->subYear(), Carbon::today());
        } elseif (request('days') == 'lastweek') {
            $from = Period::create(Carbon::today()->subDays(14), Carbon::today()->subDays(7));
        } elseif (request('days') == 'lastmonth') {
            $from = Period::create(Carbon::today()->subMonths(2), Carbon::today()->subMonths(1));
        } elseif (request('days') == 'lastyear') {
            $from = Period::create(Carbon::today()->subYears(2), Carbon::today()->subYears(1));
        }

        $res = LaravelGoogleAnalytics::getTotalUsersByDate($from);
        // $res = LaravelGoogleAnalytics::getTotalUsers($from);
        echo json_encode($res);
    }


}
