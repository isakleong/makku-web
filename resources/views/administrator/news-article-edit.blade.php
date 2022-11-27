@extends('layouts.app')

@section('title', 'Makku Frozen Food - News Article')

@section('vendorCSS')
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
            <a href="" class='sidebar-link active'>
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
                <li class="submenu-item active">
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
                                    <form action="{{ route('article.update', $article->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="categoryID">Category</label>
                                                        <select class="choices form-select" id="categoryID"  name="categoryID">
                                                            @foreach($category as $row)
                                                                {{-- <option value="{{ $item->id }}">{{ $item->name_en }}</option> --}}
                                                                @if ($row->name_en == $categorySelected->name_en)
                                                                    <option value="{{ $row->id }}" selected>{{ $row->name_en }}</option>
                                                                @else
                                                                    <option value="{{ $row->id }}">{{ $row->name_en }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('categoryID')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="title_en">Title - EN</label>
                                                        <input type="text" id="title_en" class="form-control"
                                                            name="title_en" placeholder="Title (English)" value="{{$article->title_en}}">
                                                    </div>
                                                    @error('title_en')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="title_id">Title - ID</label>
                                                        <input type="text" id="title_id" class="form-control"
                                                            name="title_id" placeholder="Title (Indonesia)" value="{{$article->title_id}}">
                                                    </div>
                                                    @error('title_id')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary" onclick="generateSlug()">Generate Slug</button>
                                                    </div>
                                                </div>

                                                <div class="col-6 mt-1">
                                                    <div class="form-group">
                                                        <label for="slug_en">Slug - EN</label>
                                                        <input type="text" id="slug_en" class="form-control"
                                                            name="slug_en" placeholder="Slug (English)" value="{{$article->slug_en}}">
                                                    </div>
                                                    @error('slug_en')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-6 mt-1">
                                                    <div class="form-group">
                                                        <label for="slug_id">Slug - ID</label>
                                                        <input type="text" id="slug_id" class="form-control"
                                                            name="slug_id" placeholder="Slug (Indonesia)" value="{{$article->slug_id}}">
                                                    </div>
                                                    @error('slug_id')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_en">Content - EN</label>
                                                        <textarea class="form-control" id="content_en" name="content_en" rows="3">{{$article->content_en}}</textarea>
                                                        @error('content_en')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_id">Content - ID</label>
                                                        <textarea class="form-control" id="content_id" name="content_id" rows="3">{{$article->content_id}}</textarea>
                                                        @error('content_id')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="tags_en">Tags - EN (Optional)</label>
                                                        <input type="text" id="tags_en" class="form-control"
                                                            name="tags_en" placeholder="Tags (English)" value="{{$article->tags_en}}">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="tags_id">Tags - ID (Optional)</label>
                                                        <input type="text" id="tags_id" class="form-control"
                                                            name="tags_id" placeholder="Tags (Indonesia)" value="{{$article->tags_id}}">
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="author">Author</label>
                                                        <input type="text" id="author" class="form-control"
                                                            name="author" placeholder="Author" value="{{$article->author}}">
                                                    </div>
                                                    @error('author')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="image">Cover Image (Optional)</label>
                                                            @if ($article->image != "")
                                                                <img src="/{{$article->image}}" alt="" class="img-preview img-fluid mb-3 mt-3 col-4 d-block"> 
                                                            @else
                                                                <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                                            @endif
                                                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
                                                        </div>
                                                    </div>
                                                    @error('image')
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

<script>
    function generateSlug(){
        var title_en = $("#title_en").val();
        var title_id = $("#title_id").val();

        if((!$("#title_en").val()) || (!$("#title_id").val()) ){
            Swal.fire({
                title: 'Please fill out Title field first',
                icon: 'warning',
                showDenyButton: false,
                confirmButtonText: 'OK'
            });
        } else {
            var slug_en = title_en.trim().toLowerCase().replace(/ /g,'-').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
            var slug_id = title_id.trim().toLowerCase().replace(/ /g,'-').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');

            $("#slug_en").val(slug_en);
            $("#slug_id").val(slug_id);
        }
    }
</script>

@endsection