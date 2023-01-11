@extends('layouts.app')

@section('title', 'Makku Frozen Food - News Article')

@section('vendorCSS')
<link rel="stylesheet" href="/lte/assets/css/pages/summernote.css">
<link rel="stylesheet" href="/lte/assets/extensions/summernote/summernote-lite.css">

<style>
    .note-editable { background-color: #f2f7ff !important; color: black !important; };
</style>
@endsection

@section('page-header', 'News Article')
@section('page-desc', 'News article master data')

@section('content')

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
                                <form action="{{ route('admin.news.article.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
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
                                                    <label for="slug">Slug</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="slug" id="slug_en" value="en"/>
                                                        <label class="form-check-label" for="slug_en">English</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="slug" id="slug_id" value="id" checked/>
                                                        <label class="form-check-label" for="slug_id">Indonesia</label>
                                                    </div>                                                        
                                                </div>
                                                {{-- @error('slugData')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror --}}
                                            </div>

                                            {{-- <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" onclick="generateSlug()">Generate Slug</button>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" id="slug" class="form-control"
                                                        name="slug" placeholder="Slug" required value="{{old('slug')}}">
                                                </div>
                                                @error('slug')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div> --}}

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
                                                    <div class="mb-3">
                                                        <label for="image">Cover Image</label>
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

{{-- <script>
    function generateSlug(){
        var slugData = "";

        var slugOption = document.getElementsByName('slugOption');
        for(i = 0; i < slugOption.length; i++) {
            if(slugOption[i].checked) {
                slugData = slugOption[i].value;
            }
        }

        if(slugData == 'en') {
            var title = $("#title_en").val();

            if((!$("#title_en").val()) ){
                $("#slug").val('');
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
        } else {
            var title = $("#title_id").val();

            if((!$("#title_id").val()) ){
                $("#slug").val('');
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
    }
</script> --}}

@endsection
