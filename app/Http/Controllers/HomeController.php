<?php

namespace App\Http\Controllers;

use App\Models\MenuBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    public function index() {
        $menubar = DB::table('menu_bar as b')
            ->select(DB::raw('b.*, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
            ->where('b.active', 1)
            ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
            ->get();

        // dd($menubar->all());
        return view('home.index', compact(['menubar']));
    }

    public function ourCompany() {
        return view('home.our-company');
    }

    public function ourProduct() {
        return view('home.our-product');
    }

    public function catalogues() {
        return view('home.catalogues');
    }

    public function partnership() {
        return view('home.partnership');
    }

    public function news() {
        return view('home.news');
    }

    public function contactUs() {
        return view('home.contact-us');
    }



}
