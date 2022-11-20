<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="/lte/assets/css/main/app.css">
    <link rel="stylesheet" href="/lte/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="/lte/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="/lte/assets/images/logo/favicon.png" type="image/png">
    <script src="/lte/assets/jquery/jquery.min.js"></script>
    @yield('vendorCSS')
</head>

<body>
    <script src="/lte/assets/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="dashboard"><img src="/lte/assets/images/logo_blue.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
    
                @yield('navbar')
            </div>
        </div>
        <div id="main">
            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-end">
                        <p>{{ date('Y') }} &copy; Makku Frozen Food</p>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="/lte/assets/js/bootstrap.js"></script>
    <script src="/lte/assets/js/app.js"></script>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    @yield('vendorScript')
</body>

</html>
