@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
      <h1>{{$sectionTitle}}</h1>
    </div>
</section>

<section id="catalogues" class="catalogues" data-aos="fade-up" data-aos-delay="100">
    <div class="container text-center">
      <div class="row">
        @foreach ($catalogue as $item)
          <div class="col-12 mb-3">
            <a href="/{{$item->file}}" download>
              <i class="bi-download"></i>
            </a>
            <h4 class="mt-5">Download E-Catalogues {{$item->name}}</h4>
          </div>
        @endforeach
      </div>
    </div>
</section>
@endsection