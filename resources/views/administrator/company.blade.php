@extends('layouts.app')

@section('title', 'Makku Frozen Food - Company')

@section('vendorCSS')
<link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
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
            <a href="" class='sidebar-link'>
                <i class="bi bi-basket-fill"></i>
                <span>Product</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/admin/product/catalogue">Catalogue</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/product/category">Category</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/product/brand">Brand</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/product">Item</a>
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
                    <a href="/admin/news/brand">Tag</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/news/article">Article</a>
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
            class="sidebar-item  has-sub active">
            <a href="/master" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Master</span>
            </a>
            <ul class="submenu active">
                <li class="submenu-item">
                    <a href="/admin/master/menubar">Menu Bar</a>
                </li>
                <li class="submenu-item">
                    <a href="/admin/master/producthighlight">Product Highlight</a>
                </li>
                <li class="submenu-item">
                    <a href="/admin/master/keyfeature">Key Feature</a>
                </li>
                <li class="submenu-item active">
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
                <h3>Company</h3>
                <p class="text-subtitle text-muted">Company master data</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Master Data</h4>
                @if (count($company) == 0)
                    <div class="buttons">
                        <a class="btn btn-outline-primary" onclick="location.href='/admin/master/company/create'">Add Data</a>
                    </div>
                @else
                    <div class="buttons">
                        <a class="btn btn-outline-primary disabled" onclick="return false;" style="cursor: not-allowed; pointer-events: all !important;">Add Data</a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($company as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{!!$item->address!!}</td>
                                <td>
                                    <a href="{{ route('company.edit', $item->id) }}" class="btn icon btn-sm btn-primary d-inline-block m-1" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('company.destroy', $item->id) }}" method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip" title="Delete">
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

        <div class="card">
            <div class="card-header">
                <h4>Master Image</h4>
                @if (count($company) == 0)
                    <div class="buttons">
                        <a class="btn btn-outline-primary" onclick="location.href='/admin/master/companyimage/create'">Add Data</a>
                    </div>
                @else
                    <div class="buttons">
                        <a href="/admin/master/companyimage/create" class="btn btn-outline-primary">Add Data</a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table2" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Order Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($companyImage as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><img src="/{{$item->image}}" alt="" class="img-fluid" width="100"></td>
                                <td>{{$item->orderNumber}}</td>
                                <td>
                                    <a href="{{ route('companyimage.edit', $item->id) }}" class="btn icon btn-sm btn-primary d-inline-block m-1" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('companyimage.destroy', $item->id) }}" method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip" title="Delete">
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
<script type="text/javascript" src="/vendor/datatable/js/datatables.min.js"></script>

<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script>
    $(document).ready(function () {
        var table1 = $('#table1').DataTable({
            responsive: true
        });

        var table2 = $('#table2').DataTable({
            responsive: true
        });

        const registerDeleteItemHandlers = () => {
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
        };

        registerDeleteItemHandlers();

        $("#table1").on("draw.dt", function () {
            registerDeleteItemHandlers();
        });

        $("#table2").on("draw.dt", function () {
            registerDeleteItemHandlers();
        });

        table1.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
            // console.log('Details for row '+row.index()+' '+(showHide ? 'shown' : 'hidden'));
            registerDeleteItemHandlers();
        });

        table2.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
            // console.log('Details for row '+row.index()+' '+(showHide ? 'shown' : 'hidden'));
            registerDeleteItemHandlers();
        });
    });
</script>

<script>
    @if($message = session('error'))
        Swal.fire(
            '{{ $message }}',
            '',
            'error'
        )
    @endif
</script>

@endsection