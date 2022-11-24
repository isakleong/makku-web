@extends('layouts.app')

@section('title', 'Makku Frozen Food - Partnership')

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
                    <a href="/admin/news/tag">Tag</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/news/article">Article</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/news">Item</a>
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
            class="sidebar-item active">
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
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Partnership</h3>
                <p class="text-subtitle text-muted">Partnership master data</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="buttons">
                    <a href="/admin/partnership" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('partnership.update', $partnership->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" id="name" class="form-control"
                                                            name="name" placeholder="Name" value="{{$partnership->name}}">
                                                    </div>
                                                    @error('name')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                {{-- <div class="col-6 mt-1">
                                                    <div class="form-group">
                                                        <img src="/{{$partnership->image}}" alt="" class="img-fluid" width="300">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="image">Image (Optional)</label>
                                                            <input class="form-control" type="file" id="image" name="image">
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="col-6 mt-1">
                                                    <div class="form-group">
                                                        <img src="/{{$partnership->logo}}" alt="" class="img-fluid" width="300">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="logo">Logo (Optional)</label>
                                                            <input class="form-control" type="file" id="logo" name="logo">
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="image">Image (Optional)</label>
                                                            @if ($partnership->image != "")
                                                                <img src="/{{$partnership->image}}" alt="" class="img-preview img-fluid mb-3 mt-3 col-4 d-block"> 
                                                                <div class="form-check">
                                                                    <div class="checkbox">
                                                                        <input name="discard-image" type="checkbox" id="checkbox3" class="form-check-input"/>
                                                                        <label for="checkbox3">Discard Old Image</label>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                                            @endif
                                                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="multiplePreviewImage('#image', '.img-preview')">
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="image">Logo (Optional)</label>
                                                            @if ($partnership->logo != "")
                                                                <img src="/{{$partnership->logo}}" alt="" class="img-preview-logo img-fluid mb-3 mt-3 col-4 d-block"> 
                                                                <div class="form-check">
                                                                    <div class="checkbox">
                                                                        <input name="discard-logo" type="checkbox" id="checkbox3" class="form-check-input"/>
                                                                        <label for="checkbox3">Discard Old Logo</label>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <img class="img-preview-logo img-fluid mb-3 mt-3 col-4">
                                                            @endif
                                                            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="image-logo" name="logo" accept="image/*" onchange="multiplePreviewImage('#image-logo', '.img-preview-logo')">
                                                        </div>
                                                    </div>
                                                    @error('logo')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="address">Address (Optional)</label>
                                                        <input type="text" id="address" class="form-control"
                                                            name="address" placeholder="Address" value="{{$partnership->address}}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="instagram">Instagram (Optional)</label>
                                                        <input type="text" id="instagram" class="form-control"
                                                            name="instagram" placeholder="Instagram" value="{{$partnership->instagram}}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="whatsapp">Whatsapp (Optional)</label>
                                                        <input type="text" id="whatsapp" class="form-control"
                                                            name="whatsapp" placeholder="Whatsapp" value="{{$partnership->whatsapp}}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="phoneNo">Phone (Optional)</label>
                                                        <input type="text" id="phoneNo" class="form-control"
                                                            name="phoneNo" placeholder="Phone" value="{{$partnership->phoneNo}}">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch">
                                                            <input name="active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $partnership->active=='1' ? 'checked' : '' }}>
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