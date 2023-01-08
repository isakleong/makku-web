<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <!-- anti-flicker snippet (recommended)  -->
  {{-- <style>.async-hide { opacity: 0 !important} </style>
  <script>
    (function(a,s,y,n,c,h,i,d,e) {
      s.className+=' '+y;h.start=1*new Date;
      h.end=i=function(){
        s.className=s.className.replace(RegExp(' ?'+y),'')
      };
      (a[n]=a[n]||[]).hide=h;
      setTimeout(function(){
        i();
        h.end=null
      },c);
        h.timeout=c;
    })(window,document.documentElement,'async-hide','dataLayer',4000,{
      'OPT-WP2W8Z7':true
    });
  </script> --}}
  
  {{-- <script src="https://www.googleoptimize.com/optimize.js?id=OPT-WP2W8Z7"></script> --}}

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/home/assets/img/favicon.png" rel="icon">
  <link href="/home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="/home/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/home/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/home/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/home/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/home/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/home/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/home/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="/home/assets/css/floating-wpp.min.css">

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"/>

  <!-- Google tag (gtag.js) -->
  {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-KRTK7GZC8H"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    // gtag('config', 'G-KRTK7GZC8H');
    gtag('config', 'GA_TRACKING_ID', { 'optimize_id': 'OPT-WP2W8Z7'});
  </script> --}}


  <!-- Google tag (gtag.js) -->
  {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-KRTK7GZC8H"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-KRTK7GZC8H');
  </script> --}}

  <style>
    .form-select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border:0px;
      outline:0px;
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: groove;
      color: #243675;
    }

    .form-select:focus {
      box-shadow: none;
      outline: none;
    }
  </style>

  @yield('vendorCSS')
</head>

<body class="go-mart food-fmcg">
{{-- <body class="d-flex flex-column h-100"> --}}
    {{-- @yield('navbar') --}}
    <header id="header" class="header fixed-top">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
  
        <a href="/" class="logo d-flex align-items-center">
          <img src="/{{$company->logoPrimary}}" alt="">
        </a>
  
        @php
          $tempChildMenuBar = $menubar;
          $tempSubChildMenuBar = $menubar;
        @endphp
  
        <nav id="navbar" class="navbar">
          <ul id="navbar-header">
            @foreach ($menubar as $item)
                @if (strtolower($item->type) == 'parent')
                  @if ($item->ChildrenCount > 0)
                    <li id="navbar-title" class="dropdown"><a href="/{{$item->refer}}"><span>{{$item->title}}</span><i class="bi bi-chevron-down"></i></a>
                      <ul>
                        @foreach ($tempChildMenuBar as $itemChild)
                          @if ($itemChild->parent == $item->id)
                            @if ($itemChild->ChildrenCount == 0)
                              <li id="navbar-dropdown" style="background-image: url(/{{$itemChild->image}});"><a href=/{{$itemChild->refer}}>{{$itemChild->title}}</a></li>
                              <div style="border-bottom: 3px solid white"></div>
                            @else
                              <li class="dropdown"><a href="/{{$itemChild->refer}}"><span>{{$itemChild->title}}</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                  @foreach ($tempSubChildMenuBar as $itemSubChild)
                                    @if ($itemSubChild->parent == $itemChild->id)
                                      <li id="navbar-sub-dropdown" style="background-image: url(/{{$itemSubChild->image}});"><a href=/{{$itemSubChild->refer}}>{{$itemSubChild->title}}</a></li>
                                    @endif
                                  @endforeach
                                </ul>
                              </li>
                            @endif
                          @endif
                        @endforeach
                      </ul>
                    </li>
                  @else
                    <li id="navbar-title"><a class="nav-link" href=/{{$item->refer}}>{{$item->title}}</a></li>
                  @endif
  
                @endif
            @endforeach
            {{-- <li id="navbar-title" class="dropdown"><a href="#"><span>EN</span> <i class="bi bi-translate"></i></a>
              <ul>
                <li><a href="/en/{{Route::current()->getName()}}">English</a></li>
                <li><a href="/id/{{Route::current()->getName()}}">Bahasa Indonesia</a></li>
              </ul>
            </li> --}}

            <li id="navbar-title" class="dropdown">
              <form id="selectbox">
                {{ csrf_field() }}
                <input type="hidden" id="uname" name="uname" required/>
                  <select id="languagedata" name="languagedata" class="form-select dropdown">
                    {{-- <option value={{ url("/en/").Route::current()->getName() }}>English</option>
                    <option value={{ url("/id/").Route::current()->getName() }}>Indonesia</option> --}}

                    @if (session('languagedata') == 'en')
                      <option value="en" selected>EN</option>
                    @else
                      <option value="en">EN</option>
                    @endif

                    @if (session('languagedata') == 'id')
                      <option value="id" selected>ID</option>
                    @else
                      <option value="id">ID</option>
                    @endif

                  </select>
              </form>
            </li>

          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
      </div>
    </header>

    <main class="component-wrapper" id="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    {{-- <footer id="footer" class="footer">
        <div class="container text-center py-4">
        <div>
            <a href="index.html"><img src="/home/assets/img/logo_white.png" alt="" width="150px"></a>
        </div>
        <div class="credits py-3">
            <h3><i class="bi bi-geo-alt-fill"></i></h3>
            <p>
                Ruko Soekarno Hatta Indah Blok A7<br>
                Mojolangu, Lowokwaru<br>
                Malang, Jawa Timur<br>
            </p>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="email"><i class="bx bxl-gmail"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
            </div>
        </div>
    </footer> --}}
    <!-- End Footer -->

    <footer id="sticky-at-bottom" class="footer mt-auto py-3">
        <div class="container py-4">
          <div class="text-center">
            <div>
              <a href="/"><img src="/{{$company->logoSecondary}}" alt="" width="150px"></a>
            </div>
            <div class="credits py-3">
              <h3><i class="bi bi-geo-alt-fill"></i></h3>
              <p>{!!$company->address!!}</p>
            </div>
    
            
          </div>
          <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="mailto:{{$company->email}}" class="email"><i class="bx bxl-gmail"></i></a>
            <a href="{{$company->facebook}}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="{{$company->instagram}}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="{{$company->whatsapp}}" target="_blank" class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
          </div>

          {{-- <div class="m-5 text-center" role="group">
            <input type="button" class="btn btn-toggle" style="color: white" value="English">
            <input type="button" style="color: white" class="btn" value="Indonesia">
          </div> --}}
          
        </div>
    </footer>
    
    <div class="floating-wpp" id="whatsappButton">
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/home/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/home/assets/vendor/aos/aos.js"></script>
    <script src="/home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/home/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/home/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/home/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/home/assets/vendor/php-email-form/validate.js"></script>
    <script src="/lte/assets/extensions/jquery/jquery.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/home/assets/js/main.js"></script>
    <script src="/home/assets/js/floating-wpp.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
          $('#languagedata').change(function() {
            var language_selected = $('#languagedata option:selected').val();

            $('#uname').val(language_selected);
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '/set_session',
                // data: language_selected,
                data: $("#selectbox").serialize()
            })
            .done(function(data){
                // console.log('/'+data+'/{{Route::current()->getName()}}');
                // window.location.href = '/'+data+'/{{Route::current()->getName()}}/';

                if('{{ Route::current()->getName() }}' == ''){
                  var urlCurrent = '{{ url()->full() }}';
                  if(data == 'en') {
                    var urlParam = urlCurrent.replace(/\bid\b/g, data);
                  } else if(data == 'id') {
                    var urlParam = urlCurrent.replace(/\ben\b/g, data);
                  }

                  window.location.href = urlParam;
                } else {
                  var urlParam = '/'+data+'/{{Route::current()->getName()}}/';
                  window.location.href = urlParam;
                }
            })
            .fail(function() {
                alert( "Posting failed." );
            });
            return false;
          });
      });
  </script>

  <script>
    $(function () {
      $('.floating-wpp').floatingWhatsApp({
        // phone: '+6281908900124',
        phone: {{$company->phone}},
        popupMessage: 'Apa yang bisa kami bantu?',
        showPopup: true,
        message: 'Saya ingin membeli barang di Makku Frozen',
        headerTitle: 'Hai!',
        zindex: 40,
        size: '60px',
        position: 'right',
        showOnIE: true
      });
    });
  </script>

    @yield('vendorScript')
</body>
</html>