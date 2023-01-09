@extends('layouts.app')

@section('title', 'Makku Frozen Food - Testimonial')

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
                {{-- <li class="submenu-item ">
                    <a href="/admin/news/tag">Tag</a>
                </li> --}}
                <li class="submenu-item ">
                    <a href="/admin/news/article">Article</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item active">
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
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Testimonial</h3>
                <p class="text-subtitle text-muted">Testimonial master data</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="buttons">
                    <a href="/admin/testimonial" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="content_en">Content - EN</label>
                                                        <input type="text" id="content_en" class="form-control"
                                                            name="content_en" placeholder="Content (English)" value="{{$testimonial->content_en}}">
                                                    </div>
                                                    @error('content_en')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_id">Content - ID</label>
                                                        <input type="text" id="content_id" class="form-control"
                                                            name="content_id" placeholder="Content (Indonesia)" value="{{$testimonial->content_id}}">
                                                    </div>
                                                    @error('content_id')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="author">Author</label>
                                                        <input type="text" id="author" class="form-control"
                                                            name="author" placeholder="Author" value="{{$testimonial->author}}">
                                                    </div>
                                                    @error('author')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch">
                                                            <input name="active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $testimonial->active=='1' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1 show_confirm">Update</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        title: 'Update the data?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Yes, update',
        denyButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

@endsection