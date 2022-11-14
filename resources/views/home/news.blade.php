@extends('layouts.main')

@section('title', 'Makku Frozen Food - News')

@section('navbar')
    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="/home/assets/img/logo_blue.png" alt="">
      </a>

      <nav id="navbar" class="navbar">
        <ul id="navbar-header">
          <li id="navbar-title"><a class="nav-link active" href="/">Home</a></li>
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
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>
  <!-- End Header -->
@endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
        <h1>NEWS</h1>
    </div>
</section>

<section id="news" class="news">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-4 mb-e d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="news-box">
                    <div class="news-img"><img src="main/assets/img/bg-news-1.jpg" class="img-fluid" alt=""></div>
                    <div class="meta">
                    <span class="news-date">Tue, December 12</span>
                    <span class="news-author"> / Julia Parker</span>
                    </div>
                    <h3 class="news-title">10 Tips Menjalankan Bisnis Frozen Food yang Sukses</h3>
                    <p>Illum voluptas ab enim placeat. Adipisci enim velit nulla. Vel omnis laudantium. Asperiores eum ipsa est officiis. Modi cupiditate exercitationem qui magni est...</p>
                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 mb-e d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                <div class="news-box">
                    <div class="news-img"><img src="main/assets/img/bg-news-2.jpg" class="img-fluid" alt=""></div>
                    <div class="meta">
                    <span class="news-date">Fri, September 05</span>
                    <span class="news-author"> / Mario Douglas</span>
                    </div>
                    <h3 class="news-title">7 Tips Bisnis Frozen Food Online dan Rincian Modalnya</h3>
                    <p>Voluptatem nesciunt omnis libero autem tempora enim ut ipsam id. Odit quia ab eum assumenda. Quisquam omnis aliquid necessitatibus tempora consectetur doloribus...</p>
                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 mb-e d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="600">
                <div class="news-box">
                    <div class="news-img"><img src="main/assets/img/bg-news-3.jpg" class="img-fluid" alt=""></div>
                    <div class="meta">
                    <span class="news-date">Tue, July 27</span>
                    <span class="news-author"> / Lisa Hunter</span>
                    </div>
                    <h3 class="news-title">8 Tips Memulai Bisnis Frozen Food</h3>
                    <p>Quia nam eaque omnis explicabo similique eum quaerat similique laboriosam. Quis omnis repellat sed quae consectetur magnam veritatis dicta nihil...</p>
                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection