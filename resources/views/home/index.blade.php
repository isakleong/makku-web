@extends('layouts.home')

@section('title', 'Makku Frozen Food - Home')

@section('navbar')
    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="/home/assets/img/logo_blue.png" alt="">
      </a>

      {{-- {{$menubar[0]->title_id}} --}}
      @php
        $tempChildMenuBar = $menubar;
        $tempSubChildMenuBar = $menubar;
      @endphp

      <nav id="navbar" class="navbar">
        <ul id="navbar-header">
          @foreach ($menubar as $item)
              @if (strtolower($item->type) == 'parent')
                @if ($item->ChildrenCount > 0)
                  <li id="navbar-title" class="dropdown"><a href="{{$item->refer}}"><span>{{$item->title_en}}</span><i class="bi bi-chevron-down"></i></a>
                    <ul>
                      @foreach ($tempChildMenuBar as $itemChild)
                        @if ($itemChild->parent == $item->id)
                          @if ($itemChild->ChildrenCount == 0)
                            <li id="navbar-dropdown" style="background-image: url(/{{$itemChild->image}});"><a href={{$itemChild->refer}}>{{$itemChild->title_en}}</a></li>
                            <div style="border-bottom: 3px solid white"></div>
                          @else
                            <li class="dropdown"><a href="{{$itemChild->refer}}"><span>{{$itemChild->title_en}}</span> <i class="bi bi-chevron-right"></i></a>
                              <ul>
                                @foreach ($tempSubChildMenuBar as $itemSubChild)
                                  @if ($itemSubChild->parent == $itemChild->id)
                                    <li id="navbar-sub-dropdown" style="background-image: url({{$itemSubChild->image}});"><a href={{$itemSubChild->refer}}>{{$itemSubChild->title_en}}</a></li>
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
                <li id="navbar-title"><a class="nav-link" href={{$item->refer}}>{{$item->title_en}}</a></li>
                @endif

              @endif
          @endforeach
          {{-- <li id="navbar-title"><a class="nav-link active" href="/">Home</a></li>
          <li id="navbar-title"><a class="nav-link" href="our-company">Our Company</a></li>
          <li id="navbar-title" class="dropdown"><a href="#"><span>Our Product</span><i class="bi bi-chevron-down"></i></a>
            <ul>
              <li id="navbar-dropdown-1"><a href="our-product">Bumbu</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-2"><a href="our-product">Saos</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-3"><a href="our-product">Sosis</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-4"><a href="our-product">Ayam, Sapi, Ikan</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-5"><a href="our-product">Nugget</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-6"><a href="our-product">Kentang</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-7"><a href="our-product">Bakso</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-8"><a href="our-product">Olahan Seafood</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li id="navbar-dropdown-9"><a href="our-product">Bakery</a></li>
              <div style="border-bottom: 3px solid white"></div>
              <li class="dropdown"><a href="#"><span>Dry</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li id="navbar-sub-dropdown-1"><a href="#">Snack</a></li>
                  <li id="navbar-sub-dropdown-2"><a href="#">Minuman</a></li>
                </ul>
              </li>
            </ul>
          </li>

          <li id="navbar-title"><a class="nav-link" href="catalogues">Catalogues</a></li>
          <li id="navbar-title"><a class="nav-link" href="partnership">Partnership / Reseller</a></li>
          <li id="navbar-title"><a class="nav-link" href="news">News</a></li>
          <li id="navbar-title"><a class="nav-link" href="contact-us">Contact Us</a></li>
          <li id="navbar-title" class="dropdown"><a href="#"><span>EN</span> <i class="bi bi-translate"></i></a>
            <ul>
              <li><a href="#">Bahasa Indonesia</a></li>
              <li><a href="#">English</a></li>
            </ul>
          </li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="/home/assets/img/bg-rev.jpg" class="img-fluid" alt="">
        </div>

        <div class="col-lg-12 d-flex flex-column justify-content-center mt-3">
          <h1 data-aos="fade-up">Frozen Food Supplier</h1>
          <p data-aos="fade-up" data-aos-delay="400">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
          <div class="col-lg-12 mt-3" data-aos="fade-in" data-aos-delay="600">
            <div class="divider div-transparent div-dot"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero -->
@endsection

@section('content')
    <!-- ======= Product Section ======= -->
    <section id="product" class="product">
        <div class="container" data-aos="fade-up">
          <header class="section-header">
            <p>Our Product</p>
          </header>
  
          <div class="row gy-4">
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Olahan Seafood</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Nugget</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Kentang</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Saos</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Pasta</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="600">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Roti</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="700">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Susu</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="800">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Snack</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="900">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Daging</h4>
                </div>
              </div>
            </div>
  
            <div class="col-md-15 col-sm-3 col-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="1000">
              <div class="product-content">
                <div class="product-content-img">
                  <img src="/home/assets/img/product/olahan-seafood.png" class="img-fluid" alt="">
                </div>
                <div class="product-content-info">
                  <h4>Sayuran Beku</h4>
                </div>
              </div>
            </div>
  
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
            <p>Our Value</p>
          </header>
          <div class="row d-flex align-items-stretch">
            <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="200">
              <div class="box">
                <!-- <img src="/home/assets/img/values-1.png" class="img-fluid" alt=""> -->
                <p>Consultation</p>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="400">
              <div class="box">
                <p>Delivery All Indonesia</p>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="600">
              <div class="box">
                <p>Partnership</p>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="600">
              <div class="box">
                <p>All in One Frozen Big Solution</p>
              </div>
            </div>
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
            <p>Testimonial</p>
          </header>
  
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>Terima kasih, harga murah dan terjamin kualitasnya</p>
                  <h3>Mia Rose</h3>
                </div>
              </div>
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>Proin iaculis </p>
                </div>
              </div>
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>Proin iaculis </p>
                </div>
              </div>
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>Proin iaculis </p>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
  
        </div>
      </section>
      <!-- End Testimonials Section -->
@endsection