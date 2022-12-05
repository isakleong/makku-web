@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
        @if (strtolower(Session::get('languagedata')) == 'id')
          <h1><img class="img-fluid" src="/{{$product_category->image}}" width="150">{{strtoupper($product_category->name_id)}}</h1>
        @else
          <h1><img class="img-fluid" src="/{{$product_category->image}}" width="150">{{strtoupper($product_category->name_en)}}</h1>
        @endif
    </div>
</section>

@if ($product_category->product->count())
  <section id="our-product" class="our-product" data-aos="zoom-in" data-aos-delay="100">
    <div class="container">
      <div class="row">
        @foreach ($product_category->product as $item)
          <div class="col-xs-6 col-lg-4 mb-4">
            <div class="card-product">
                <div class="card-body">
                    <img id="our-product-image" class="img-fluid" src="/{{$item->image}}">
                </div>
                <div class="card-footer">
                    <p class="mt-3">{{$item->brand->name}}</p>
                    @if (strtolower(Session::get('languagedata')) == 'id')
                      <p class="mt-3">{{$item->name_id}}</p>
                    @else
                      <p class="mt-3">{{$item->name_en}}</p>
                    @endif
                </div>
            </div>
          </div>
        @endforeach
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




@endsection