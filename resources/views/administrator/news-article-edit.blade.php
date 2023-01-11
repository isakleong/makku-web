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
                                <form action="{{ route('admin.news.article.update', $article->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
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

                                            {{-- <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" onclick="generateSlug()">Generate Slug</button>
                                                </div>
                                            </div> --}}

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" id="slug" class="form-control"
                                                        name="slug" placeholder="Slug" value="{{$article->slug}}">
                                                </div>
                                                @error('slug')
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

                                            {{-- <div class="col-12 mt-1">
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
                                            </div> --}}

                                            {{-- <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="author">Author</label>
                                                    <input type="text" id="author" class="form-control"
                                                        name="author" placeholder="Author" value="{{$article->author}}">
                                                </div>
                                                @error('author')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div> --}}

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
            callbacks: {
                // onImageUpload: function(files, editor, welEditable) {
                //     sendFile(files[0], editor, welEditable);
                // },
                onMediaDelete : function(target) {
                    // alert(target[0].src);
                    // deleteFile(target[0].src);
                }
            }
        });

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '{{ route('admin.images.store') }}',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url);
                }
            });
        }

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

{{-- <script>
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
</script> --}}

@endsection