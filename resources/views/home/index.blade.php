@extends('layouts.home')

@section('title') {{$company->name}} @endsection

@section('content')
  <!-- ======= Company Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="/{{$company->image}}" class="img-fluid" alt="">
        </div>

        <div class="col-lg-12 d-flex flex-column justify-content-center mt-3" data-aos="fade-in" data-aos-delay="400">
          <h1>{{$company->highlight}}</h1>
          <p>{!!$company->description!!}</p>
          <div class="col-lg-12 mt-3">
            <div class="divider div-transparent div-dot"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Company -->

    <!-- ======= Product Section ======= -->
    <section id="product" class="product">
        <div class="container" data-aos="fade-up">
          <header class="section-header">
            <p>{{$productHighlight[0]->sectionTitle}}</p>
          </header>

          <div class="container-fluid">
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
              @php
                $delay = 100
              @endphp
              @foreach ($productHighlight as $item)
                <div class="col" data-aos="zoom-in" data-aos-delay="{{$delay}}">
                  <div class="product-content p-3 border h-100">
                    <img class="img-fluid" src="/{{$item->image}}" alt="">
                    <p>{{$item->name}}</p>
                  </div>
                </div>
                @php
                  $delay+=100;
                @endphp
              @endforeach
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