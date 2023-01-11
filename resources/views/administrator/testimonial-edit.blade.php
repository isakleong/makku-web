@extends('layouts.app')

@section('title', 'Makku Frozen Food - Testimonial')

@section('page-header', 'Testimonial')
@section('page-desc', 'Testimonial master data')

@section('content')

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