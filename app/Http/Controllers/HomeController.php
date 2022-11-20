<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\MenuBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

    public function index($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            if($locale == "en") {
                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                $productHighlight = DB::table('product_highlight as tbl_product')
                ->select(DB::raw('"Our Product" as sectionTitle, tbl_product.name_en as name, tbl_product.image'))
                ->where('tbl_product.active', 1)
                ->orderByRaw('tbl_product.orderNumber+0')
                ->get();

                $keyFeature = DB::table('key_feature as tbl_keyFeature')
                ->select(DB::raw('"Our Value" as sectionTitle, tbl_keyFeature.name_en as name, tbl_keyFeature.image'))
                ->where('tbl_keyFeature.active', 1)
                ->orderByRaw('tbl_keyFeature.orderNumber+0')
                ->get();

                $testimonial = DB::table('testimonial as tbl_testimonial')
                ->select(DB::raw('"Testimonial" as sectionTitle, tbl_testimonial.content_en as content, tbl_testimonial.author'))
                ->where('tbl_testimonial.active', 1)
                ->get();

            } elseif($locale == "id") {
                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp'))
                ->get()->first();

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $productHighlight = DB::table('product_highlight as tbl_product')
                ->select(DB::raw('"Produk Kami" as sectionTitle, tbl_product.name_id as name, tbl_product.image'))
                ->where('tbl_product.active', 1)
                ->orderByRaw('tbl_product.orderNumber+0')
                ->get();

                $keyFeature = DB::table('key_feature as tbl_keyFeature')
                ->select(DB::raw('"Nilai Kami" as sectionTitle, tbl_keyFeature.name_id as name, tbl_keyFeature.image'))
                ->where('tbl_keyFeature.active', 1)
                ->orderByRaw('tbl_keyFeature.orderNumber+0')
                ->get();

                $testimonial = DB::table('testimonial as tbl_testimonial')
                ->select(DB::raw('"Testimoni" as sectionTitle, tbl_testimonial.content_en as content, tbl_testimonial.author'))
                ->where('tbl_testimonial.active', 1)
                ->get();
            }
            return view('home.index', compact(['menubar', 'company', 'productHighlight', 'keyFeature', 'testimonial']));
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
