<?php

namespace App\Http\Controllers;

use App\Models\MenuBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    // public function checker($data) {
    //     $lan = $data::
    // }

    public function index($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            if($locale == "en") {
                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

            } elseif($locale == "id") {
                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();
            }
            return view('home.index', compact(['menubar']));
        } else {
            abort(404);
        }
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
