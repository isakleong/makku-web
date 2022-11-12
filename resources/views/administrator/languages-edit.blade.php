@extends('layouts.app')

@section('title', 'Makku Frozen Food - Languages')

@section('vendorCSS')
<link rel="stylesheet" href="/lte/assets/extensions/simple-datatables/style.css">
<link rel="stylesheet" href="/lte/assets/css/pages/simple-datatables.css">
@endsection

@section('navbar')
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        
        <li
            class="sidebar-item ">
            <a href="/admin/dashboard" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li
            class="sidebar-item ">
            <a href="/" target="_blank" class='sidebar-link'>
                <i class="bi bi-globe"></i>
                <span>Go To Website</span>
            </a>
        </li>

        <li
            class="sidebar-item  has-sub">
            <a href="/product" class='sidebar-link'>
                <i class="bi bi-basket-fill"></i>
                <span>Products</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/admin/product-category">Category</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/product-brand">Brand</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/product">Item</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item ">
            <a href="/admin/news" class='sidebar-link'>
                <i class="bi bi-newspaper"></i>
                <span>News</span>
            </a>
        </li>
        
        <li
            class="sidebar-item ">
            <a href="/admin/partnership" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Partnership</span>
            </a>
        </li>

        <li
            class="sidebar-item ">
            <a href="/admin/catalogues" class='sidebar-link'>
                <i class="bi bi-card-list"></i>
                <span>Catalogues</span>
            </a>
        </li>

        <li
            class="sidebar-item active has-sub active">
            <a href="/master" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Master</span>
            </a>
            <ul class="submenu active">
                <li class="submenu-item active ">
                    <a href="/admin/languages">Languages</a>
                </li>
                <li class="submenu-item ">
                    <a href="#">Modules</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item  has-sub">
            <a href="/pages" class='sidebar-link'>
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Pages</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/admin/pages/home">Home</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/pages/about">About</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/pages/contact-us">Contact Us</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item ">
            <a href="/" target="_blank" class='sidebar-link'>
                <i class="bi bi-power"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Languages</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="buttons">
                    <a href="/admin/languages" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h1>sdsd</h1>
                                    {{-- <h1>{{ dd($language->id) }}</h1> --}}
                                    {{-- <form action="{{ route('languages.update', $language->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="language-code">Language Code</label>
                                                        <input type="text" id="languageCode" class="form-control"
                                                            name="languageCode" placeholder="Language Code" value="{{$language->languageCode}}">
                                                    </div>
                                                    @error('languageCode')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" id="name" class="form-control"
                                                            name="name" placeholder="Name" value="{{$language->name}}">
                                                    </div>
                                                    @error('name')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1 show_confirm">Save</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </section>
</div>
@endsection

@section('vendorScript')

<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script>

    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
            title: 'Are you sure you want to save?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.isDenied) {
                    // Swal.fire('Changes are not saved', '', 'info');
                }
            });
        });
</script>

@endsection