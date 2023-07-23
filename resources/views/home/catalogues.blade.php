@extends('layouts.home')

@section('title') {{$sectionTitle}} @endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
      <h1>{{$sectionTitle}}</h1>
    </div>
</section>

@if ($catalogue->count())
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