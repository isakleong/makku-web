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

<section id="catalogues" class="catalogues" data-aos="fade-up" data-aos-delay="100">
    <div class="container text-center">
        <i class="bi-download"></i>
        <h4 class="mt-5">Download E-Catalogues</h4>
    </div>
</section>
@endsection