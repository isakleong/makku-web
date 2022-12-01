@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
        <h1><img class="img-fluid" src="/{{$product_category->image}}" width="150">{{strtoupper($product_category->name_en)}}</h1>
    </div>
</section>

{{-- <h1>{{$product_category->product[1]->name_en}}</h1> --}}

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
                    <p class="mt-3">{{$item->name_en}}</p>
                </div>
            </div>


            {{-- <div class="icon-box text-center">

            </div> --}}
          </div>
        @endforeach
    </div>
  </section>


@endsection