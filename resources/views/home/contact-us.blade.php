@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

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

<div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <img class="img-fluid" src="/lte/assets/images/samples/contact.svg" alt="Not Found" />
        </div>
        <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
            <div class="text-center">
                <h3><i class="bi bi-geo-alt-fill" style="color:#243675;"></i></h3>
                <p>{!!$company->address!!}</p>
            </div>

            <div class="text-center mt-1">
                <h3><i class="bi bi-envelope"></i></h3>
                <p>{{ $company->email }}</p>
            </div>

            <div class="text-center mt-1">
                <h3><i class='bx bx-phone'></i></i></h3>
                <p>{{ $company->phone }}</p>
            </div>
        </div>
    </div>
</div>
@endsection