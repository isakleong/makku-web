
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

@include('sweetalert::alert')

{{-- @if ($message = Session::get('message'))
    
    <script>
        alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->persistent('Dismiss');
    </script>
@endif --}}


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
                    <a href="/admin/languages/create" class="btn btn-outline-primary">Add Data</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Language Code</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($languages as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->languageCode}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a href="{{ route('languages.edit', $item->id) }}" class="btn icon btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('languages.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn icon btn-sm btn-danger show_confirm"><i class="bi bi-x"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection

@section('vendorScript')

<script src="/lte/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="/lte/assets/js/pages/simple-datatables.js"></script>

<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script>
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
            title: 'Are you sure you want to delete this data?',
            text: "If you delete this, it will be gone forever.",
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

{{-- <script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script> --}}

@endsection