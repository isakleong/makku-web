@extends('layouts.home')

@section('title') {{$company->name}} @endsection

@php
    
@endphp

@section('navbar')
    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="/{{$company->logoPrimary}}" alt="">
      </a>

      @php
        $tempChildMenuBar = $menubar;
        $tempSubChildMenuBar = $menubar;
      @endphp

      {{-- <input id="language-data" value="English"/> --}}

      <nav id="navbar" class="navbar">
        <ul id="navbar-header">
          @foreach ($menubar as $item)
              @if (strtolower($item->type) == 'parent')
                @if ($item->ChildrenCount > 0)
                  <li id="navbar-title" class="dropdown"><a href="{{$item->refer}}"><span>{{$item->title}}</span><i class="bi bi-chevron-down"></i></a>
                    <ul>
                      @foreach ($tempChildMenuBar as $itemChild)
                        @if ($itemChild->parent == $item->id)
                          @if ($itemChild->ChildrenCount == 0)
                            <li id="navbar-dropdown" style="background-image: url(/{{$itemChild->image}});"><a href={{$itemChild->refer}}>{{$itemChild->title}}</a></li>
                            <div style="border-bottom: 3px solid white"></div>
                          @else
                            <li class="dropdown"><a href="{{$itemChild->refer}}"><span>{{$itemChild->title}}</span> <i class="bi bi-chevron-right"></i></a>
                              <ul>
                                @foreach ($tempSubChildMenuBar as $itemSubChild)
                                  @if ($itemSubChild->parent == $itemChild->id)
                                    <li id="navbar-sub-dropdown" style="background-image: url({{$itemSubChild->image}});"><a href={{$itemSubChild->refer}}>{{$itemSubChild->title}}</a></li>
                                  @endif
                                @endforeach
                              </ul>
                            </li>
                          @endif
                        @endif
                      @endforeach
                    </ul>
                  </li>
                @else
                  <li id="navbar-title"><a class="nav-link" href={{$item->refer}}>{{$item->title}}</a></li>
                @endif

              @endif
          @endforeach
          <li id="navbar-title" class="dropdown"><a href="#"><span>EN</span> <i class="bi bi-translate"></i></a>
            <ul>
              <li><a href="/en">English</a></li>
              <li><a href="/id">Bahasa Indonesia</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Company Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="/{{$company->image}}" class="img-fluid" alt="">
        </div>

        <div class="col-lg-12 d-flex flex-column justify-content-center mt-3">
          <h1 data-aos="fade-up">{{$company->highlight}}</h1>
          <p data-aos="fade-up" data-aos-delay="400">{{$company->description}}</p>
          <div class="col-lg-12 mt-3" data-aos="fade-in" data-aos-delay="600">
            <div class="divider div-transparent div-dot"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Company -->
@endsection

@section('content')
    <!-- ======= Product Section ======= -->
    <section id="product" class="product">
        <div class="container" data-aos="fade-up">
          <header class="section-header">
            <p>{{$productHighlight[0]->sectionTitle}}</p>
          </header>
  
          <div class="row gy-4">

            @php
              $delay = 100
            @endphp

            @foreach ($productHighlight as $item)
              <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{$delay}}">
                <div class="product-content">
                  <div class="product-content-img">
                    <img src="/{{$item->image}}" class="img-fluid" alt="">
                  </div>
                  <div class="product-content-info">
                    <h4>{{$item->name}}</h4>
                  </div>
                </div>
              </div>

              @php
                $delay+=100;
              @endphp
            @endforeach
          </div>
          <div class="col-lg-12 d-flex flex-column justify-content-center mt-3" data-aos="fade-in" data-aos-delay="600">
            <div class="divider div-transparent div-dot"></div>
          </div>
        </div>
      </section>
      <!-- End product Section -->
  
      <!-- ======= Values Section ======= -->
      <section id="values" class="values">
        <div class="container" data-aos="fade-up">
          <header class="section-header">
            <p>{{$keyFeature[0]->sectionTitle}}</p>
          </header>
          <div class="row d-flex align-items-stretch">
            @php
              $delay = 200
            @endphp

            @foreach ($keyFeature as $item)
              <div class="col-lg-3 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="{{$delay}}">
                <div class="box">
                  @if ($item->image != "")
                    <img src="/{{$item->image}}" class="img-fluid" alt="">
                  @endif
                  <p>{{$item->name}}</p>
                </div>
              </div>  

              @php
                $delay+=200
              @endphp
            @endforeach

          </div>
          <div class="col-lg-12 d-flex flex-column justify-content-center mt-3" data-aos="fade-in" data-aos-delay="600">
            <div class="divider div-transparent div-dot"></div>
          </div>
        </div>
      </section>
      <!-- End Values Section -->
  
      <!-- ======= Testimonials Section ======= -->
      <section id="testimonials" class="testimonials">
  
        <div class="container" data-aos="fade-up">
  
          <header class="section-header">
            <p>{{$testimonial[0]->sectionTitle}}</p>
          </header>
  
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">
              @foreach ($testimonial as $item)
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <p>{{$item->content}}</p>
                    <h3>{{$item->author}}</h3>
                  </div>
                </div>  
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
  
        </div>
      </section>
      <!-- End Testimonials Section -->
@endsection