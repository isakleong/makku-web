@extends('layouts.home')

@section('title') {{$sectionTitle}} @endsection

@section('content')
 <!-- ======= Breadcrumbs ======= -->
 <section class="breadcrumbs">
    <div class="container" data-aos="fade-in">
      <ol>
        @if (strtolower(Session::get('languagedata')) == 'id')
          <li style="font-weight:bold;"><a href="/">Beranda</a></li>
          <li style="font-weight:bold;"><a href="/id/news/">Berita</a></li>
          <li style="font-weight:bold;"><a href="/id/news/{{ $news_category->slug }}">{{ $news_category->name_id }}</a></li>
          <li>{{ $news_article->title_id }}</li>
        @else
          <li style="font-weight:bold;"><a href="/">Home</a></li>
          <li style="font-weight:bold;"><a href="/en/news/">News</a></li>
          {{-- <li><a href="/news/{{ $news_category->slug }}">{{ $news_category->name_en }}</a></li> --}}

          <li style="font-weight:bold;"><a href="/en/news/{{ $news_category->slug }}">{{ $news_category->name_en }}</a></li>
          <li>{{ $news_article->title_en }}</li>
        @endif
      </ol>
    </div>
  </section>
  <!-- End Breadcrumbs -->

  <!-- ======= Blog Detail Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-12 entries">
          <article class="entry entry-single">
            <div class="entry-img">
              <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
            </div>

            @if (strtolower(Session::get('languagedata')) == 'id')
              <h1 class="display-5 entry-title">{{$news_article->title_id}}</h1>
            @else
              <h1 class="display-5 entry-title">{{$news_article->title_en}}</h1>
            @endif

            <div class="entry-meta">
              <ul>
                @if (strtolower(Session::get('languagedata')) == 'id')
                  <li class="d-flex align-items-center"><i class="bi bi-tags"></i>{{$news_article->category->name_id}}</li>
                @else
                  <li class="d-flex align-items-center"><i class="bi bi-tags"></i>{{$news_article->category->name_en}}</li>
                @endif
                @php
                  $date = date_create($news_article->publish_date);
                  $strDate = date_format($date,'d M Y')
                @endphp
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i>{{$strDate}}</li>
              </ul>
            </div>

            <div class="entry-content">
              @if (strtolower(Session::get('languagedata')) == 'id')
                {!!$news_article->content_id!!}
              @else
                {!!$news_article->content_en!!}
              @endif
            </div>

            {{-- <div class="entry-footer">
              <i class="bi bi-folder"></i>
              <ul class="cats">
                <li><a href="#">Business</a></li>
              </ul>

              <i class="bi bi-tags"></i>
              <ul class="tags">
                <li><a href="#">Creative</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>
            </div> --}}

          </article>
        <!-- End blog entry -->
@endsection