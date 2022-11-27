@extends('layouts.home')

@section('title') {{$company->name}} - {{$sectionTitle}}  @endsection

@section('content')
<section class="breadcrumbs" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
        <table>
            <tbody>
                <tr>
                  @php
                    $arrSectionTitle = explode("/",$sectionTitle);
                  @endphp
                    <td class="align-baseline"><h1>{{$arrSectionTitle[0]}}</h1></td>
                    <td class="align-middle"><img class="mx-auto d-block" src="/home/assets/img/handshake.png" width="100px;"/></td>
                    <td class="align-bottom"><h1>{{$arrSectionTitle[1]}}</h1></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section id="partnership" class="partnership" data-aos="zoom-in" data-aos-delay="100">
    <div class="container">
      <div class="row">
        @foreach ($partnership as $item)
          <div class="col-md-6 mb-4">
            <div class="icon-box">
              <div class="row">
                <div class="col-4 pb-3">
                    <img class="img-fluid" src="/{{$item->logo}}">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <h4><a href="#">{{$item->name}}</a></h4>
                  <i class="bi-instagram"></i><p>{{$item->instagram}}</p>
                  <i class="bi-whatsapp"></i><p>{{$item->whatsapp}}</p>
                  <i class="bi-shop"></i><p>{{$item->address}}</p>
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


@endsection