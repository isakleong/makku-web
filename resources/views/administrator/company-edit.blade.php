@extends('layouts.app')

@section('title', 'Makku Frozen Food - Company')

@section('vendorCSS')
<link rel="stylesheet" href="/lte/assets/css/pages/summernote.css">
<link rel="stylesheet" href="/lte/assets/extensions/summernote/summernote-lite.css">
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
                <h3>Company</h3>
                <p class="text-subtitle text-muted">Company master data</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="buttons">
                    <a href="/admin/master/company" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('company.update', $company->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="name_en">Name</label>
                                                        <input type="text" id="name" class="form-control"
                                                            name="name" placeholder="Name (English)" value="{{$company->name}}">
                                                    </div>
                                                    @error('name')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3">{{$company->address}}</textarea>
                                                        @error('address')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="highlight_en">Highlight EN</label>
                                                        <input type="text" id="highlight_en" class="form-control"
                                                            name="highlight_en" placeholder="Highlight (English)" value="{{$company->highlight_en}}">
                                                    </div>
                                                    @error('highlight_en')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="highlight_id">Highlight ID</label>
                                                        <input type="text" id="highlight_id" class="form-control"
                                                            name="highlight_id" placeholder="Highlight (Indonesia)" value="{{$company->highlight_id}}">
                                                    </div>
                                                    @error('highlight_id')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="description_en">Description EN</label>
                                                        <textarea class="form-control" id="description_en" name="description_en" rows="3">{{$company->description_en}}</textarea>
                                                        @error('description_en')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="description_id">Description ID</label>
                                                        <textarea class="form-control" id="description_id" name="description_id" rows="3">{{$company->description_id}}</textarea>
                                                        @error('description_id')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="about_en">About EN</label>
                                                        <textarea class="form-control" id="about_en" name="about_en" rows="3">{{$company->about_en}}</textarea>
                                                        @error('about_en')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="about_id">About ID</label>
                                                        <textarea class="form-control" id="about_id" name="about_id" rows="3">{{$company->about_id}}</textarea>
                                                        @error('about_id')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="image">Highlight Image</label>
                                                            @if ($company->image != "")
                                                                <img src="/{{$company->image}}" alt="" class="img-preview img-fluid mb-3 mt-3 col-4 d-block"> 
                                                            @else
                                                                <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                                            @endif
                                                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="highlight-image" name="image" accept="image/*" onchange="companyImagePreview('#highlight-image', '.img-preview')">
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="logoPrimary">Logo Primary</label>
                                                            @if ($company->logoPrimary != "")
                                                                <img src="/{{$company->logoPrimary}}" alt="" class="img-preview-logo-primary img-fluid mb-3 mt-3 col-4 d-block" style="background: lightgrey"> 
                                                            @else
                                                                <img class="img-preview-logo-primary img-fluid mb-3 mt-3 col-4">
                                                            @endif
                                                            <input class="form-control @error('logoPrimary') is-invalid @enderror" type="file" id="logo-primary-image" name="logoPrimary" accept="image/*" onchange="companyImagePreview('#logo-primary-image', '.img-preview-logo-primary')">
                                                        </div>
                                                    </div>
                                                    @error('logoPrimary')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="logoSecondary">Logo Secondary</label>
                                                            @if ($company->logoSecondary != "")
                                                                <img src="/{{$company->logoSecondary}}" alt="" class="img-preview-logo-secondary img-fluid mb-3 mt-3 col-4 d-block" style="background: lightgrey">
                                                            @else
                                                                <img class="img-preview-logo-secondary img-fluid mb-3 mt-3 col-4">
                                                            @endif
                                                            <input class="form-control @error('logoSecondary') is-invalid @enderror" type="file" id="logo-secondary-image" name="logoSecondary" accept="image/*" onchange="companyImagePreview('#logo-secondary-image', '.img-preview-logo-secondary')">
                                                        </div>
                                                    </div>
                                                    @error('logoSecondary')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="social-mail">Email</label>
                                                        <input type="text" id="social-mail" class="form-control"
                                                            name="social-mail" placeholder="Email" value="{{$company->email}}">
                                                    </div>
                                                    @error('social-mail')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="social-facebook">Facebook</label>
                                                        <input type="text" id="social-facebook" class="form-control"
                                                            name="social-mail" placeholder="Facebook" value="{{$company->facebook}}">
                                                    </div>
                                                    @error('social-facebook')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="social-instagram">Instagram</label>
                                                        <input type="text" id="social-instagram" class="form-control"
                                                            name="social-mail" placeholder="Instagram" value="{{$company->instagram}}">
                                                    </div>
                                                    @error('social-instagram')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="social-whatsapp">Whatsapp</label>
                                                        <input type="text" id="social-whatsapp" class="form-control"
                                                            name="social-mail" placeholder="Whatsapp" value="{{$company->whatsapp}}">
                                                    </div>
                                                    @error('social-whatsapp')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
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

<script src="/lte/assets/extensions/jquery/jquery.min.js"></script>
<script src="/lte/assets/extensions/summernote/summernote-lite.min.js"></script>
<script src="/lte/assets/js/pages/summernote.js"></script>

<script>
    $(document).ready(function(){
        $('#address').summernote({
            spellCheck: false,
            disableDragAndDrop: true,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });

        $('#description_en').summernote({
            spellCheck: false,
            disableDragAndDrop: true,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });

        $('#description_id').summernote({
            spellCheck: false,
            disableDragAndDrop: true,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });

        $('#about_en').summernote({
            spellCheck: false,
            disableDragAndDrop: true,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });

        $('#about_id').summernote({
            spellCheck: false,
            disableDragAndDrop: true,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });
    });
</script>

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