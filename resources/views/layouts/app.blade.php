<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="/lte/assets/css/main/app.css">
    <link rel="shortcut icon" href="/lte/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="/lte/assets/images/logo/favicon.png" type="image/png">

    <style>
        #loading {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0.7;
            background-color: #fff;
            z-index: 9999999;
        }

        #loading-image {
        z-index: 100;
        }
    </style>

    <script src="/lte/assets/jquery/jquery.min.js"></script>
    @yield('vendorCSS')
</head>

<body>
    <script src="/lte/assets/js/initTheme.js"></script>
    <div id="loading">
        <img id="loading-image" src="/lte/assets/images/loader_7.gif" alt="Loading..." />
    </div>
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
                                @if ((str_contains(Route::currentRouteName(), 'dashboard')  == true))
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Dashboard Data</h5>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.catalogue')  == true))
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
                                @if ((str_contains(Route::currentRouteName(), 'dashboard')  == true))
                                    <p>Menampilkan data dari google analytic.</p>
                                    <strong>Data yang ditampilkan adalah:</strong>
                                    <ul>
                                        <li>Views</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Total website dilihat selama periode tertentu.</p>
                                        <li>Visitors</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Total pengunjung website selama periode tertentu.</p>
                                        <li>Returning Visitors</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Total pengunjung website yang sudah pernah mengunjungi sebelumnya, tetapi kembali mengunjungi website selama periode tertentu.</p>
                                        <li>Average Sessions</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Rata-rata lama pengunjung melihat website (dalam detik) selama periode tertentu.</p>
                                        <li>Most Views By Page</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Grafik peringkat tertinggi halaman yang dikunjungi selama periode tertentu. Peringkat bisa diatur range nya (misal 10 besar).</p>
                                        <li>Total Visitors By Date</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Grafik total pengunjung website berdasarkan tanggal selama periode tertentu.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.catalogue')  == true))
                                    <p>Berfungsi untuk mengatur data katalog produk.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama katalog (English).</p>
                                        <li>Name - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama katalog (Bahasa Indonesia).</p>
                                        <li>File</li>
                                        <p><i class="bi bi-arrow-return-right"></i> File katalog (bisa berupa file / gambar).</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.category')  == true))
                                    <p>Berfungsi untuk mengatur data kategori produk. Misalnya, Olahan Seafood, Sosis, Nugget, Dry, dll.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama kategori produk (English).</p>
                                        <li>Name - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama kategori produk (Bahasa Indonesia).</p>
                                        <li>Slug</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Slug di-generate secara otomatis oleh sistem. Saat menambahkan data, Admin dapat memilih apakah Slug di-generate menggunakan Bahasa Indonesia / English. Jika memilih Bahasa Indonesia, maka Slug di-generate berdasarkan data Name-ID, dan sebaliknya. Slug juga bisa di-edit secara manual.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.brand')  == true))
                                    <p>Berfungsi untuk mengatur data brand (merk) produk.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama brand / merk.</p>
                                        <li>Slug</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Slug di-generate secara otomatis oleh sistem berdasarkan data Name. Slug juga bisa di-edit secara manual.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'product.item')  == true))
                                    <p>Berfungsi untuk mengatur data produk.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama produk (English).</p>
                                        <li>Name - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama produk (Bahasa Indonesia).</p>
                                        <li>Slug</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Slug di-generate secara otomatis oleh sistem. Saat menambahkan data, Admin dapat memilih apakah Slug di-generate menggunakan Bahasa Indonesia / English. Jika memilih Bahasa Indonesia, maka Slug di-generate berdasarkan data Name-EN, dan sebaliknya. Slug juga bisa di-edit secara manual.</p>
                                        <li>Image</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Gambar produk.</p>
                                        <li>Category</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Kategori produk.</p>
                                        <li>Brand</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Brand produk.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'news.category')  == true))
                                    <p>Berfungsi untuk mengatur data kategori berita.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama kategori berita (English).</p>
                                        <li>Name - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama kategori berita (Bahasa Indonesia).</p>
                                        <li>Slug</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Slug di-generate secara otomatis oleh sistem. Saat menambahkan data, Admin dapat memilih apakah Slug di-generate menggunakan Bahasa Indonesia / English. Jika memilih Bahasa Indonesia, maka Slug di-generate berdasarkan data Name-EN, dan sebaliknya. Slug juga bisa di-edit secara manual.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'news.article')  == true))
                                    <p>Berfungsi untuk mengatur data artikel (konten berita).</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Title - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Judul artikel (English).</p>
                                        <li>Title - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Judul artikel (Bahasa Indonesia).</p>
                                        <li>Content - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Konten artikel (English).</p>
                                        <li>Slug</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Slug di-generate secara otomatis oleh sistem. Saat menambahkan data, Admin dapat memilih apakah Slug di-generate menggunakan Bahasa Indonesia / English. Jika memilih Bahasa Indonesia, maka Slug di-generate berdasarkan data Title-EN, dan sebaliknya. Slug juga bisa di-edit secara manual.</p>
                                        <li>Content - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Konten artikel (English).</p>
                                        <li>Content - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Konten artikel (Bahasa Indonesia).</p>
                                        <li>Cover Image</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Gambar cover artikel.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'testimonial')  == true))
                                    <p>Berfungsi untuk mengatur data testimoni.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Content - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Isi testimoni (English).</p>
                                        <li>Content - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Isi testimoni (Bahasa Indonesia).</p>
                                        <li>Author</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Pemberi testimoni.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'partnership')  == true))
                                    <p>Berfungsi untuk mengatur data kemitraan (partnership).</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama mitra.</p>
                                        <li>Image</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Foto mitra.</p>
                                        <li>Logo</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Logo mitra.</p>
                                        <li>Address</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Alamat mitra.</p>
                                        <li>Instagram</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Instagram mitra.</p>
                                        <li>Facebook</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Facebook mitra.</p>
                                        <li>Whatsapp</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Whatsapp mitra.</p>
                                        <li>Phone</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nomor telepon mitra.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.menubar')  == true))
                                    <p>Berfungsi untuk mengatur data kemitraan (partnership).</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama menu (English).</p>
                                        <li>Name - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama menu (Bahasa Indonesia).</p>
                                        <li>Refer</li>
                                        <p><i class="bi bi-arrow-return-right"></i> URL path.</p>
                                        <li>Type</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Tipe menu (Parent / Child / Sub Child).</p>
                                        <li>Parent</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Menu parent (Khusus Child / Sub Child).</p>
                                        <li>Image</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Icon menu.</p>
                                        <li>Order Number</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Urutan menu.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.producthighlight')  == true))
                                    <p>Berfungsi untuk mengatur data highlight produk.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama produk (English).</p>
                                        <li>Name - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama produk (Bahasa Indonesia).</p>
                                        <li>Image</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Gambar produk.</p>
                                        <li>Order Number</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Urutan produk.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.keyfeature')  == true))
                                    <p>Berfungsi untuk mengatur data key feature (value perusahaan).</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama value (English).</p>
                                        <li>Name - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama value (Bahasa Indonesia).</p>
                                        <li>Image</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Icon value.</p>
                                        <li>Order Number</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Urutan value.</p>
                                        <li>Active</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Indikator data aktif / tidak. Jika tidak aktif, maka data akan disembunyikan dari User.</p>
                                    </ul>
                                @elseif ((str_contains(Route::currentRouteName(), 'master.company')  == true))
                                    <p>Berfungsi untuk mengatur data master perusahaan.</p>
                                    <strong>Struktur Data</strong>
                                    <ul>
                                        <li>Name</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nama perusahaan.</p>
                                        <li>Address</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Alamat.</p>
                                        <li>Highlight - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Company highlight (English). Ditampilkan di Homepage.</p>
                                        <li>Highlight - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Company highlight (Bahasa Indonesia). Ditampilkan di Homepage.</p>
                                        <li>Description - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Company highlight description (English). Ditampilkan di Homepage.</p>
                                        <li>Description - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Company highlight description (Bahasa Indonesia). Ditampilkan di Homepage.</p>
                                        <li>About - EN</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Penjelasan tentang perusahaan (English). Ditampilkan di halaman Our-Company.</p>
                                        <li>About - ID</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Penjelasan tentang perusahaan (Bahasa Indonesia). Ditampilkan di halaman Our-Company.</p>
                                        <li>Highlight Image</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Gambar company highlight.</p>
                                        <li>Logo Primary</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Logo utama.</p>
                                        <li>Logo Sekunder</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Logo sekunder.</p>
                                        <li>Email</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Email perusahaan.</p>
                                        <li>Facebook</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Facebook perusahaan.</p>
                                        <li>Instagram</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Instagram perusahaan.</p>
                                        <li>Whatsapp</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Link chat whatsapp perusahaan.</p>
                                        <li>Phone</li>
                                        <p><i class="bi bi-arrow-return-right"></i> Nomor whatsapp perusahaan.</p>
                                    </ul>

                                @endif

                                
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button> --}}
                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">OK</span>
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

    <script>
        $(function() {
            $( "form" ).submit(function() {
                $('#loader').show();
            });
        });
    </script>

    <script>
        $(window).on('load', function () {
            $('#loading').hide();
        });
    </script>

    @yield('vendorScript')
</body>

</html>
