<?php

namespace App\Http\Controllers;

use App\Models\MenuBar;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        $menubar = MenuBar::all();
        // dd($menubar);
        return view('home.index', compact(
            'menubar'
        ));
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
