@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('vendorCSS')
<link href="/home/assets/css/news.css" rel="stylesheet">

<style>
    .input-group input {
        border: 1.2px solid #444444;
    }
    .input-group input:focus {
      box-shadow: none !important;
      outline: none;
    }
</style>
@endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
      <h1>{{$news_category->name_en}}</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="?">
                    <div class="input-group input-group-lg mt-4">
                        @if (strtolower(Session::get('languagedata')) == 'id')
                            <input type="text" class="form-control" placeholder="Cari..." name="search" value="{{ request('search') }}">
                        @else
                            <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                        @endif
                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if ($news_category->news->count())
    <section>
        <div class="container">
            <div class="o-row o-row--slider">
                @foreach ($news_category->news as $item)
                    <div class="o-row--slider__col-3 c-list-grid-item mb-5" data-aos="fade-up" data-aos-delay="200">
                        <a href="/news/{{$news_category->slug}}/{{$item->slug}}">
                            <div class="col-12">
                                <div class="c-blog-hl-wrapper--one lazy">
                                    <picture class="lazy loaded">
                                        <source>
                                        <img src="/{{$item->image}}" class="c-blog-hl-image-helper lazy loaded">
                                    </picture>
                                    <picture class="lazy loaded">
                                        <source>
                                        <img src="/{{$item->image}}" class="c-blog-hl-image lazy loaded">
                                    </picture>
                                </div>
                            </div>
                            @if (strtolower(Session::get('languagedata')) == 'id')
                                <h3 class="col-12 c-blog-highlight__title">{{$item->title_id}}</h3>
                            @else
                                <h3 class="col-12 c-blog-highlight__title">{{$item->title_en}}</h3>
                            @endif
                            <div class="mt-auto col-12 row justify-content-between">
                                @php
                                    $date = date_create($item->publishDate);
                                    $strDate = date_format($date,'d M Y')
                                @endphp
                                @if (strtolower(Session::get('languagedata')) == 'id')
                                    <span class="c-blog-highlight__date">{{$news_category->slug}} / {{$strDate}}</span>
                                @else
                                    <span class="c-blog-highlight__date">{{$news_category->slug}} / {{$strDate}}</span>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@else
    <div class="container" data-aos="fade-up" data-aos-delay="300">
        <div class="row text-center">
            <div class="col-lg-12 mb-3 mt-3">
                <img class="img-fluid" src="/lte/assets/images/samples/not-found.jpg" width="300" alt="Not Found" />
                @if (strtolower(Session::get('languagedata')) == 'id')
                    <h3>Data tidak ditemukan</h3>
                @else
                    <h3>Not found</h3>
                @endif
            </div>
        </div>
    </div>
@endif

{{-- <section id="news" class="news">
    <div class="container" data-aos="fade-up">
        <div class="row">
          @foreach ($news_category->news as $item)
          <div class="col-lg-4 mb-e d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="news-box">
                <div class="news-img"><img src="/{{$item->image}}" class="img-fluid" alt=""></div>
                <div class="meta">
                <span class="news-author">{{$news_category->slug}}</span>
                @php
                  $date = date_create($item->publish_date);
                  $strDate = date_format($date,'d M Y')
                @endphp
                <span class="news-date"> / {{$strDate}}</span>
                </div>
                <h3 class="news-title">{{$item->title_en}}</h3>
                <a href="{{$news_category->slug}}/{{$item->slug}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
          @endforeach
        </div>
    </div>
</section> --}}
@endsection