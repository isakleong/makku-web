@extends('layouts.app')

@section('title', 'Makku Frozen Food - News Article')

@section('vendorCSS')
{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="/lte/assets/extensions/quill/quill.snow.css"> --}}
{{-- <link rel="stylesheet" href="/lte/assets/extensions/quill/quill.bubble.css"> --}}

<link rel="stylesheet" href="/lte/assets/css/pages/summernote.css">
<link rel="stylesheet" href="/lte/assets/extensions/summernote/summernote-lite.css">

<style>
    .note-editable { background-color: #f2f7ff !important; color: black !important; };
</style>

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
            <ul class="submenu">
                <li class="submenu-item ">
                    <a href="/admin/product/catalogue">Catalogue</a>
                </li>
                <li class="submenu-item">
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
            class="sidebar-item  has-sub active">
            <a href="" class='sidebar-link'>
                <i class="bi bi-newspaper"></i>
                <span>News</span>
            </a>
            <ul class="submenu v">
                <li class="submenu-item ">
                    <a href="/admin/news/category">Category</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/news/tag">Tag</a>
                </li>
                <li class="submenu-item active">
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
                <h3>News Article</h3>
                <p class="text-subtitle text-muted">News article master data</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="buttons">
                    <a href="/admin/news/article" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('article.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title_en">Title - EN</label>
                                                        <input type="text" id="title_en" class="form-control"
                                                            name="title_en" placeholder="Title (English)" required value="{{old('title_en')}}">
                                                    </div>
                                                    @error('title_en')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="title_id">Title - ID</label>
                                                        <input type="text" id="title_id" class="form-control"
                                                            name="title_id" placeholder="Title (Indonesia)" required value="{{old('title_id')}}">
                                                    </div>
                                                    @error('title_id')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_en">Content - EN</label>
                                                        <textarea class="form-control" id="content_en" name="content_en" rows="3" style="display: none;"></textarea>
                                                        @error('content_en')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_id">Content - ID</label>
                                                        <textarea class="form-control" id="content_id" name="content_id" rows="3" style="display: none;" required value="{{old('content_id')}}"></textarea>
                                                        @error('content_id')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="tags_en">Tags - EN (Optional)</label>
                                                        <input type="text" id="tags_en" class="form-control"
                                                            name="tags_en" placeholder="Tags (English)">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="tags_id">Tags - ID (Optional)</label>
                                                        <input type="text" id="tags_id" class="form-control"
                                                            name="tags_id" placeholder="Tags (Indonesia)">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="author">Author</label>
                                                        <input type="text" id="author" class="form-control"
                                                            name="author" placeholder="Author" required value="{{old('author')}}">
                                                    </div>
                                                    @error('author')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1 show_confirm">Add</button>
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

{{-- <script src="/lte/assets/extensions/quill/quill.min.js"></script>
<script src="/lte/assets/js/pages/quill.js"></script> --}}

<script src="/lte/assets/extensions/jquery/jquery.min.js"></script>
<script src="/lte/assets/extensions/summernote/summernote-lite.min.js"></script>
<script src="/lte/assets/js/pages/summernote.js"></script>

{{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    var toolbarOptions = [['bold', 'italic'], ['link', 'image']];
    var quill = new Quill('#full', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow',
        handlers: {
            'image': function (value) {
                if (value) {
                    document.querySelector('#imageUpload').click();
                } else {
                    this.quill.format('image', false);
                }
            }
        }
    });

    quill.on('text-change', function(delta, oldDelta, source) {
        if (source == 'api') {
            console.log("An API call triggered this change.");
        } else if (source == 'user') {
            $('#content_en').val(quill.getText(0, quill.getLength()));
            console.log(quill.getText(0, quill.getLength()));
        }
    });

</script> --}}

<script>
    $(document).ready(function(){
        $('#content_en').summernote({
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

        $('#content_id').summernote({
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
        title: 'Add the data?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Yes, add',
        denyButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

@endsection
