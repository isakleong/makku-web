@extends('layouts.app')

@section('title', 'Makku Frozen Food - News Category')

@section('page-header', 'News Category')
@section('page-desc', 'News Category master data')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="/admin/news/category" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('admin.news.category.update', $category->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name_en">Name - EN</label>
                                                    <input type="text" id="name_en" class="form-control"
                                                        name="name_en" placeholder="Name (English)" value="{{$category->name_en}}">
                                                </div>
                                                @error('name_en')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="name_id">Name - ID</label>
                                                    <input type="text" id="name_id" class="form-control"
                                                        name="name_id" placeholder="Name (Indonesia)" value="{{$category->name_id}}">
                                                </div>
                                                @error('name_id')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" id="slug" class="form-control"
                                                        name="slug" placeholder="Slug" value="{{$category->slug}}">
                                                </div>
                                                @error('slug')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            {{-- <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" onclick="generateSlug()">Generate Slug</button>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" id="slug" class="form-control"
                                                        name="slug" placeholder="Slug" value="{{$category->slug}}">
                                                </div>
                                                @error('slug')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div> --}}

                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input name="active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $category->active=='1' ? 'checked' : '' }}>
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

<script>
    function generateSlug(){
        var title = $("#name_id").val();

        if((!$("#name_id").val()) ){
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

@endsection