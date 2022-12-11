@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
      @php
        $arrSectionTitle = array();
        if (str_contains($sectionTitle, '/')) {
          $arrSectionTitle = explode("/",$sectionTitle);
        }
      @endphp

      @if (count($arrSectionTitle) > 0)
        <table>
          <tbody>
              <tr>
                <div class="col-4">
                  <td class="align-baseline"><h1 class="display-5">{{$arrSectionTitle[0]}}</h1></td>
                </div>
                <div class="col-4">
                  <td class="align-middle"><img width="60" class="mx-auto d-block" src="/home/assets/img/handshake.png"/></td>
                </div>
                <div class="col-4">
                  <td class="align-bottom"><h1 class="display-5">{{$arrSectionTitle[1]}}</h1></td>
                </div>
              </tr>
          </tbody>
        </table>
        {{-- <div class="row">
          <div class="col-4">
            <h1 class="display-5">{{strtoupper($arrSectionTitle[0])}}</h1>
          </div>
          <div class="col-6">
            <img class="img-fluid" src="/home/assets/img/handshake.png" width="100"/>
            <h1 class="display-5 ms-5">{{strtoupper($arrSectionTitle[1])}}</h1>
          </div>
        </div> --}}
      @else
        <div class="row">
          <div class="col-12">
            <h1 class="display-5">{{strtoupper($sectionTitle)}}</h1>
          </div>
        </div>
      @endif
    </div>
</section>

@if ($partnership->count())
  <section id="partnership" class="partnership" data-aos="zoom-in" data-aos-delay="100">
    <div class="container">
      <div class="row">
        @foreach ($partnership as $item)
          <div class="col-md-6 mb-4 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="row align-items-center">
                <div class="col-4">
                    <img class="img-fluid" src="/{{$item->logo}}">
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col-md-6">
                  <h4>{{$item->name}}</h4>
                  @if ($item->instagram != "")
                    <i class="bi-instagram"></i><p>{{$item->instagram}}</p>    
                  @endif

                  @if ($item->whatsapp != "")
                    <i class="bi-whatsapp"></i><p>{{$item->whatsapp}}</p>
                  @endif

                  @if ($item->address != "")
                    <i class="bi-shop"></i><p>{{$item->address}}</p>
                  @endif

                  @if ($item->phoneNo != "")
                    <i class="bi-telephone"></i><p>{{$item->phoneNo}}</p>
                  @endif
                  
                </div>
                <div class="col-md-6">
                  <img class="img-fluid" src="/{{$item->image}}">
                </div>
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