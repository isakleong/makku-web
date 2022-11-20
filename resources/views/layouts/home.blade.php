<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/home/assets/img/favicon.png" rel="icon">
  <link href="/home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

  <style>
    input[type='button'].btn-toggle {
      background: #6A72A3;
      color: #fff;
    }
  </style>

  @yield('vendorCSS')
</head>

<body>
    @yield('navbar')
    <main id="main">
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
              <p>{{$company->address}}</p>
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
    {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> --}}

    <!-- Template Main JS File -->
    <script src="/home/assets/js/main.js"></script>

    {{-- <script>
      $(document).ready(() => {
        $("input[type='button']").click((event) => {
          $("input[type='button']").toggleClass("btn-toggle");
          var inputString = $(".btn-toggle").val();
          console.log(inputString);
          $("#language-data").val(inputString);

          var val = inputString;
          $.ajax ({
            url: "index.php",
            type: "GET",
            data: { val : val },
            success: function(data) {
                // alert(data);
                $("#language-data").val(data);
            }
          });


        });
      });
    </script> --}}

    @yield('vendorScript')
</body>
</html>