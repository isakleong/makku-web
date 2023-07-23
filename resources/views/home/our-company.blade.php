@extends('layouts.home')

@section('title') {{$sectionTitle}} @endsection

{{-- @section('title') {{$company->name}} @endsection --}}

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="display-5">{{strtoupper($sectionTitle)}}</h1>
        </div>
      </div>
    </div>
</section>

<section id="about" class="about" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
      <div class="row align-items-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
              <p>{!!$company->about!!}</p>
              <hr>
          </div>
          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
            @foreach ($companyImage as $item)

              <div class="col-lg-10 mb-3 pt-lg-0">
                <img src="/{{$item->image}}" class="img-fluid" alt="">
              </div>
              
            @endforeach
          </div>
      </div>
    </div>
</section>
@endsection