@extends('layouts.app')

@section('title', 'Makku Frozen Food - News Article')

@section('vendorCSS')
{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="/lte/assets/extensions/quill/quill.snow.css"> --}}
{{-- <link rel="stylesheet" href="/lte/assets/extensions/quill/quill.bubble.css"> --}}

{{-- <link rel="stylesheet" href="/lte/assets/css/pages/summernote.css">
<link rel="stylesheet" href="/lte/assets/extensions/summernote/summernote-lite.css"> --}}

{{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script> --}}

<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

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
            <ul class="submenu">
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
                                    <form action="{{ route('article.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="categoryID">Category</label>
                                                        <select class="choices form-select" id="categoryID"  name="categoryID">
                                                            @foreach($category as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name_en }}</option>
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
                                                        <button type="button" class="btn btn-primary" onclick="generateSlug()">Generate Slug</button>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="slug">Slug</label>
                                                        <input type="text" id="slug" class="form-control"
                                                            name="slug" placeholder="Slug" required value="{{old('slug')}}">
                                                    </div>
                                                    @error('slug')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="slug">Content - EN</label>
                                                        <textarea class="form-control" id="content_en" name="content_en" rows="3"></textarea>
                                                        @error('content_en')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="slug">Content - ID</label>
                                                        <textarea class="form-control" id="content_id" name="content_id" rows="3"></textarea>
                                                        @error('content_id')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_en">Content - EN</label>
                                                        <input id="content_en" type="hidden" name="content_en">
                                                        <trix-editor input="content_en"></trix-editor>
                                                        @error('content_en')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_id">Content - EN</label>
                                                        <input id="content_id" type="hidden" name="content_id">
                                                        <trix-editor input="content_id" x-data="{
                                                            
                                                        }">

                                                        </trix-editor>
                                                        @error('content_id')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_en">Content - EN</label>
                                                        <textarea class="form-control" id="content_en" name="content_en" rows="3" style="display: none;"></textarea>
                                                        @error('content_en')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="content_id">Content - ID</label>
                                                        <textarea class="form-control" id="content_id" name="content_id" rows="3" style="display: none;" required value="{{old('content_id')}}"></textarea>
                                                        @error('content_id')
                                                            <p style="color: red">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div> --}}

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="image">Cosver Image</label>
                                                            <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
                                                        </div>
                                                    </div>
                                                    @error('image')
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

{{-- uncomment --}}
<script src="/lte/assets/extensions/jquery/jquery.min.js"></script>
{{-- <script src="/lte/assets/extensions/summernote/summernote-lite.min.js"></script>
<script src="/lte/assets/js/pages/summernote.js"></script> --}}

{{-- <script>
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
</script> --}}

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

<script>
    function generateSlug(){
        var title = $("#title_id").val();

        if((!$("#title_id").val()) ){
            Swal.fire({
                title: 'Please fill out Title field first',
                icon: 'warning',
                showDenyButton: false,
                confirmButtonText: 'OK'
            });
        } else {
            var slug = title.trim().toLowerCase().replace(/\d+|^\s+|\s+$/g,"").replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "");

            $("#slug").val(slug);
        }
    }
</script>


<script>
    class MyUploadAdapter {
    // ...

    constructor( loader ) {
        // The file loader instance to use during the upload. It sounds scary but do not
        // worry — the loader will be passed into the adapter later on in this guide.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // Initializes the XMLHttpRequest object using the URL passed to the constructor.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open( 'POST', '{{ route('images.store') }}', true );
        xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve( {
                default: response.url
            } );
        } );

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest( file ) {
        // Prepare the form data.
        const data = new FormData();

        data.append( 'upload', file );

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
        this.xhr.send( data );
    }

    // ...
}

function SimpleUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}


    ClassicEditor
        .create( document.querySelector( '#content_en' ), {
            extraPlugins: [ SimpleUploadAdapterPlugin ]
        })
        .catch( error => {
            console.error( error );
        } );

</script>

@endsection
