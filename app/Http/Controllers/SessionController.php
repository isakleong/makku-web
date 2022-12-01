<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function createsession(Request $request)
    {
        Session::put('languagedata', $request->languagedata);
        echo $request->languagedata;
        // echo "/".$request->langaugedata."/".'{{Route::current()->getName()}}';
    }
    public function getsession()
    {
        // dd(Session::get('uname'));
    }
}
