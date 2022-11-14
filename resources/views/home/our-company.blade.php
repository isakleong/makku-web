@extends('layouts.main')

@section('title', 'Makku Frozen Food - Our Company')

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
        <h1>OUR COMPANY</h1>
    </div>
</section>

<section id="about" class="about" data-aos="fade-up" data-aos-delay="100">
    <div class="container">

      <div class="row align-items-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
              <p>
                  PT. Makanan Beku Indonesia Group is a growing name in the food distribution industry. We aim to build our reputation in the industry through our full end-to-end service, with guaranteed quality products, stock safety, and comprehensive customer interactions. <br><br> By connecting and building relationships with our customers, we will be better informed of what products will provide them with the most value.
              </p>
              <hr>
          </div>
          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
              <div class="col-lg-10 mb-4 pt-lg-0">
                  <img src="main/assets/img/our-company-1.jpg" class="img-fluid" alt="">
              </div>

              <div class="col-lg-10 mb-4 pt-lg-0">
                  <img src="main/assets/img/our-company-2.jpeg" class="img-fluid" alt="">
              </div>

              <div class="col-lg-10 mb-4 pt-lg-0">
                  <img src="main/assets/img/our-company-3.jpeg" class="img-fluid" alt="">
              </div>
          </div>
      </div>
    </div>
</section>
@endsection