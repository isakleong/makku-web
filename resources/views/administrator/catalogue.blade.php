@extends('layouts.app')

@section('title', 'Makku Frozen Food - Catalogue')

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
            class="sidebar-item  has-sub active">
            <a href="" class='sidebar-link'>
                <i class="bi bi-basket-fill"></i>
                <span>Product</span>
            </a>
            <ul class="submenu active">
                <li class="submenu-item active">
                    <a href="/admin/product/catalogue">Catalogue</a>
                </li>
                <li class="submenu-item">
                    <a href="/admin/product/category">Category</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/product/brand">Brand</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/product/item">Item</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item  has-sub">
            <a href="" class='sidebar-link'>
                <i class="bi bi-newspaper"></i>
                <span>News</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/admin/news/category">Category</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/news/tag">Tag</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/news/article">Article</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/news/item">Item</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item ">
            <a href="/admin/testimonial" class='sidebar-link'>
                <i class="bi bi-chat-heart-fill"></i>
                <span>Testimonial</span>
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
            class="sidebar-item  has-sub">
            <a href="/master" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Master</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item">
                    <a href="/admin/master/menubar">Menu Bar</a>
                </li>
                <li class="submenu-item">
                    <a href="/admin/master/producthighlight">Product Highlight</a>
                </li>
                <li class="submenu-item">
                    <a href="/admin/master/keyfeature">Key Feature</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/master/company">Company</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/languages">Languages</a>
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
@endsection

@section('content')
@include('sweetalert::alert')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Catalogue</h3>
                <p class="text-subtitle text-muted">Catalogue master data</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="buttons">
                    <a href="/admin/product/catalogue/create" class="btn btn-outline-primary">Add Data</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name - EN</th>
                            <th>Name - ID</th>
                            <th>File</th>
                            <th>Active</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($catalogue as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name_en}}</td>
                                <td>{{$item->name_id}}</td>
                                <td>
                                    <a href="/{{$item->file}}" class="btn icon btn-sm btn-primary" download><i class="bi bi-arrow-down"></i></a>
                                </td>
                                @if ($item->active=='1')
                                    <td><span class="badge bg-success">Active</span></td>
                                @else
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('catalogue.edit', $item->id) }}" class="btn icon btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('catalogue.destroy', $item->id) }}" method="POST">
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
        title: 'Delete the data?',
        text: "If you delete this, it will be gone forever.",
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Yes, delete',
        denyButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDenied) {
                // Swal.fire('Changes are not saved', '', 'info');
            }
        });
    });
</script>

@endsection