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

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        
                        <li class="sidebar-item {{ (Route::currentRouteName() == 'admin.dashboard') ? 'active' : '' }}">
                            <a href="/admin/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                
                        <li class="sidebar-item">
                            <a href="/" target="_blank" class='sidebar-link'>
                                <i class="bi bi-globe"></i>
                                <span>Go To Website</span>
                            </a>
                        </li>
                
                        <li class="sidebar-item has-sub {{ (str_contains(Route::currentRouteName(), 'admin.product')  == true) ? 'active' : '' }}">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Product</span>
                            </a>
                            <ul class="submenu {{ (str_contains(Route::currentRouteName(), 'admin.product')  == true) ? 'active' : '' }}">
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'product.catalogue')  == true) ? 'active' : '' }}">
                                    <a href="/admin/product/catalogue">Catalogue</a>
                                </li>
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'product.category')  == true) ? 'active' : '' }}">
                                    <a href="/admin/product/category">Category</a>
                                </li>
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'product.brand')  == true) ? 'active' : '' }}">
                                    <a href="/admin/product/brand">Brand</a>
                                </li>
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'product.item')  == true) ? 'active' : '' }}">
                                    <a href="/admin/product/item">Item</a>
                                </li>
                            </ul>
                        </li>
                
                        <li
                            class="sidebar-item  has-sub {{ (str_contains(Route::currentRouteName(), 'news')  == true) ? 'active' : '' }}">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-newspaper"></i>
                                <span>News</span>
                            </a>
                            <ul class="submenu {{ (str_contains(Route::currentRouteName(), 'news')  == true) ? 'active' : '' }}">
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'news.category')  == true) ? 'active' : '' }}">
                                    <a href="/admin/news/category">Category</a>
                                </li>
                                {{-- <li class="submenu-item ">
                                    <a href="/admin/news/tag">Tag</a>
                                </li> --}}
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'news.article')  == true) ? 'active' : '' }}">
                                    <a href="/admin/news/article">Article</a>
                                </li>
                            </ul>
                        </li>
                
                        <li
                            class="sidebar-item {{ (str_contains(Route::currentRouteName(), 'testimonial')  == true) ? 'active' : '' }}">
                            <a href="/admin/testimonial" class='sidebar-link'>
                                <i class="bi bi-chat-heart-fill"></i>
                                <span>Testimonial</span>
                            </a>
                        </li>
                        
                        <li
                            class="sidebar-item {{ (str_contains(Route::currentRouteName(), 'partnership')  == true) ? 'active' : '' }}">
                            <a href="/admin/partnership" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Partnership</span>
                            </a>
                        </li>
                
                        <li
                            class="sidebar-item  has-sub {{ (str_contains(Route::currentRouteName(), 'master')  == true) ? 'active' : '' }}">
                            <a href="/master" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Master</span>
                            </a>
                            <ul class="submenu {{ (str_contains(Route::currentRouteName(), 'master')  == true) ? 'active' : '' }}">
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'master.menubar')  == true) ? 'active' : '' }}">
                                    <a href="/admin/master/menubar">Menu Bar</a>
                                </li>
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'master.producthighlight')  == true) ? 'active' : '' }}">
                                    <a href="/admin/master/producthighlight">Product Highlight</a>
                                </li>
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'master.keyfeature')  == true) ? 'active' : '' }}">
                                    <a href="/admin/master/keyfeature">Key Feature</a>
                                </li>
                                <li class="submenu-item {{ (str_contains(Route::currentRouteName(), 'master.company')  == true) ? 'active' : '' }}">
                                    <a href="/admin/master/company">Company</a>
                                </li>
                            </ul>
                        </li>
                
                        <li
                            class="sidebar-item ">
                            <a href="/admin/logout" class='sidebar-link'>
                                <i class="bi bi-power"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
    
                {{-- @yield('navbar') --}}
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-11 order-md-1 order-first">
                            <h3>@yield('page-header')</h3>
                            <p class="text-subtitle text-muted">@yield('page-desc')</p>
                        </div>
                        <div class="col-12 col-md-1 order-md-2 order-last">
                            <button type="button" class="btn btn-outline-danger mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Help</button>
                        </div>
                    </div>
                </div>

                <!--scrolling content Modal -->
                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                @if ((str_contains(Route::currentRouteName(), 'product.catalogue')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Catalogue Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.category')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Product Category Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.brand')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Product Brand Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.item')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Product Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'news.category')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">News Category Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'news.article')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">News Article Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'testimonial')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Testimonial Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'partnership')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Partnership Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.menubar')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Menu Bar Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.producthighlight')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Product Highlight Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.keyfeature')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Key Feature Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.company')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Company Data</h5>
                                @endif
                                
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if ((str_contains(Route::currentRouteName(), 'product.catalogue')  == true))
                                    <p>Berfungsi untuk mengatur data katalog produk.</p>
                                    <p>
                                        <b>Struktur Data</b><br>
                                        1. Name - EN<br>
                                        --> Nama katalog (English). <br><br>
                                        2. Name - ID<br>
                                        --> Nama katalog (Indonesian). <br><br>
                                        3. File<br>
                                        --> File katalog (berupa file / gambar).<br><br>
                                        4. Active<br>
                                        --> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.<br><br>
                                    </p>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.category')  == true))
                                    <p>Berfungsi untuk mengatur data kategori produk. Misalnya, Olahan Seafood, Sosis, Nugget, Dry, dll.</p>
                                    <p>
                                        <b>Struktur Data</b><br>
                                        1. Name - EN<br>
                                        --> Nama kategori produk (English). <br><br>
                                        2. Name - ID<br>
                                        --> Nama kategori produk (Indonesian). <br><br>
                                        3. Slug<br>
                                        --> Berperan penting untuk SEO (Search Engine Optimization). Saat menambahkan data, Slug di-generate oleh sistem secara otomatis. Admin dapat memilih Slug di-generate menggunakan Bahasa Indonesia atau English. Jika memilih Bahasa Indonesia, maka Slug akan di-generate berdasarkan data Name-ID, dan sebaliknya.<br><br>Saat mengedit data, Slug dapat diedit secara manual.<br><br>
                                        4. Image<br>
                                        --> Gambar kategori produk.<br><br> 
                                        5. Active<br>
                                        --> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.<br><br>
                                    </p>
                                @endif

                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Accept</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>


            

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

        function multiplePreviewImage(imageData, previewData) {
            const image = document.querySelector(imageData);
            const imgPreview = document.querySelector(previewData);

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
