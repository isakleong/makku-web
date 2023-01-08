<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\MenuBar;
use App\Models\News;
use App\Models\NewsArticle;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function tesgojek(){
        return view('home.tesgojek');
    }

    public function index($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
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
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp. phone'))
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

    public function ourCompany($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'Our Company';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, about_en as about, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                $companyImage = DB::table('company_image')
                ->select(DB::raw('image'))
                ->orderByRaw('company_image.orderNumber+0')
                ->get();

            } elseif($locale == "id") {
                $sectionTitle = 'Tentang Kami';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, about_id as about, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                $companyImage = DB::table('company_image')
                ->select(DB::raw('image'))
                ->orderByRaw('company_image.orderNumber+0')
                ->get();
            }
            return view('home.our-company', compact(['sectionTitle', 'menubar', 'company', 'companyImage']));
        } else {
            abort(404);
        }
    }

    public function ourProduct($locale = 'en', $category) {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'Partnership / Reseller';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

            } elseif($locale == "id") {
                $sectionTitle = 'Kemitraan';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();
            }

            $partnership = Partnership::all()->where('active', 1);

            return view('home.our-product', compact(['sectionTitle', 'menubar', 'company', 'partnership']));
        } else {
            abort(404);
        }
    }

    public function catalogues($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'Catalogue';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                $catalogue = DB::table('catalogue')
                ->select(DB::raw('file, name_en as name'))
                ->where('active', 1)
                ->get();

            } elseif($locale == "id") {
                $sectionTitle = 'Katalog';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                $catalogue = DB::table('catalogue')
                ->select(DB::raw('file, name_id as name'))
                ->where('active', 1)
                ->get();
            }
            return view('home.catalogues', compact(['sectionTitle', 'menubar', 'company', 'catalogue']));
        } else {
            abort(404);
        }
    }

    public function partnership($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'Partnership / Reseller';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

            } elseif($locale == "id") {
                $sectionTitle = 'Kemitraan';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();
            }

            $partnership = Partnership::all()->where('active', 1);

            return view('home.partnership', compact(['sectionTitle', 'menubar', 'company', 'partnership']));
        } else {
            abort(404);
        }
    }

    public function news($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'News';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp', 'phone'))
                ->get()->first();

                // $news = DB::table('news')
                // ->join('news_category', 'news_category.id', '=', 'news.categoryID')
                // ->join('news_article', 'news_article.id', '=', 'news.articleID')
                // ->select(DB::raw('news.*, news_category.name_en as category, news_article.image as image, news_article.title_en as title, news_article.content_en as content, news_article.tags_en as tags, news_article.author, news_article.created_at as publishDate'))
                // ->where('news.active', 1)
                // ->where('news_category.active', 1)
                // ->orderByRaw('news.created_at')
                // ->get();

                $news = DB::table('news_article')
                ->join('news_category', 'news_category.id', '=', 'news_article.categoryID')
                ->select(DB::raw('news_article.*, news_category.name_en as category, news_article.image as image, news_article.title_en as title, news_article.slug as slug, news_article.content_en as content, news_article.created_at as publishDate'))
                ->where('news_category.active', 1)
                ->get();

            } elseif($locale == "id") {
                $sectionTitle = 'Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp', 'phone'))
                ->get()->first();

                // $news = DB::table('news')
                // ->join('news_category', 'news_category.id', '=', 'news.categoryID')
                // ->join('news_article', 'news_article.id', '=', 'news.articleID')
                // ->select(DB::raw('news.*, news_category.name_id as category, news_article.image as image, news_article.title_id as title, news_article.content_id as content, news_article.tags_id as tags, news_article.author, news_article.created_at as publishDate'))
                // ->where('news.active', 1)
                // ->where('news_category.active', 1)
                // ->orderByRaw('news.created_at')
                // ->get();

                $news = DB::table('news_article')
                ->join('news_category', 'news_category.id', '=', 'news_article.categoryID')
                ->select(DB::raw('news_article.*, news_category.name_id as category, news_article.image as image, news_article.title_id as title, news_article.slug as slug, news_article.content_id as content, news_article.created_at as publishDate'))
                ->where('news_category.active', 1)
                ->get();
            }

            return view('home.news', compact(['sectionTitle', 'menubar', 'company', 'news']));
        } else {
            abort(404);
        }
    }

    public function newsDetail($locale = 'en') {

        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'News';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

                $news = DB::table('news')
                ->join('news_category', 'news_category.id', '=', 'news.categoryID')
                ->join('news_article', 'news_article.id', '=', 'news.articleID')
                ->select(DB::raw('news.*, news_category.name_en as category, news_article.image as image, news_article.title_en as title, news_article.content_en as content, news_article.tags_en as tags, news_article.author, news_article.created_at as publishDate'))
                ->where('news.active', 1)
                ->where('news_category.active', 1)
                ->orderByRaw('news.created_at')
                ->get();

            } elseif($locale == "id") {
                $sectionTitle = 'Berita';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp', 'phone'))
                ->get()->first();

                $news = DB::table('news')
                ->join('news_category', 'news_category.id', '=', 'news.categoryID')
                ->join('news_article', 'news_article.id', '=', 'news.articleID')
                ->select(DB::raw('news.*, news_category.name_id as category, news_article.image as image, news_article.title_id as title, news_article.content_id as content, news_article.tags_id as tags, news_article.author, news_article.created_at as publishDate'))
                ->where('news.active', 1)
                ->where('news_category.active', 1)
                ->orderByRaw('news.created_at')
                ->get();
            }

            return view('home.news-detail', compact(['sectionTitle', 'menubar', 'company', 'news']));
        } else {
            abort(404);
        }
    }

    public function contactUs($locale = 'en') {
        $availableLanguage = ['en', 'id'];

        if(in_array($locale, $availableLanguage)) {
            Session::put('languagedata', $locale);

            if($locale == "en") {
                $sectionTitle = 'Contact Us';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_en as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_en as highlight, description_en as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();

            } elseif($locale == "id") {
                $sectionTitle = 'Hubungi Kami';

                $menubar = DB::table('menu_bar as b')
                ->select(DB::raw('b.id, b.title_id as title, b.refer, b.type, b.parent, b.image, (select count(*) from menu_bar s where s.parent=b.id) as ChildrenCount'))
                ->where('b.active', 1)
                ->orderByRaw('CASE WHEN b.type="parent" THEN 1 WHEN b.type="child" THEN 2 WHEN b.type="sub child" THEN 3 END, b.orderNumber+0')
                ->get();

                $company = DB::table('company')
                ->select(DB::raw('name, highlight_id as highlight, description_id as description, image, logoPrimary, logoSecondary, address, email, facebook, instagram, whatsapp, phone'))
                ->get()->first();
            }

            return view('home.contact-us', compact(['sectionTitle', 'menubar', 'company']));
        } else {
            abort(404);
        }
    }



}
