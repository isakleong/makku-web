@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
      <h1>{{$sectionTitle}}</h1>
    </div>
</section>

<section id="news" class="news">
    <div class="container" data-aos="fade-up">
        <div class="row">
          @foreach ($news as $item)
          <div class="col-lg-4 mb-e d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="news-box">
                <div class="news-img"><img src="/{{$item->image}}" class="img-fluid" alt=""></div>
                <div class="meta">
                <span class="news-author">{{$item->category}}</span>
                @php
                  $date = date_create($item->publishDate);
                  $strDate = date_format($date,'d M Y')
                @endphp
                <span class="news-date"> / {{$strDate}}</span>
                </div>
                <h3 class="news-title">{{$item->title}}</h3>
                
                {{-- <a href="news/{{$item->category}}/{{$item->slug}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a> --}}
                <a href="news/{{$item->slug}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
          @endforeach

            {{-- <div class="col-lg-4 mb-e d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
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
            </div> --}}
        </div>
    </div>
</section>
@endsection