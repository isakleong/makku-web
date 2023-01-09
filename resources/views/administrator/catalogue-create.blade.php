@extends('layouts.app')

@section('title', 'Makku Frozen Food - Catalogue')

@section('page-header', 'Catalogue')
@section('page-desc', 'Catalogue master data')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="/admin/product/catalogue" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('admin.product.catalogue.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name_en">Name - EN (Optional)</label>
                                                    <input type="text" id="name_en" class="form-control"
                                                        name="name_en" placeholder="Name (English)">
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="name_id">Name - ID (Optional)</label>
                                                    <input type="text" id="name_id" class="form-control"
                                                        name="name_id" placeholder="Name (Indonesia)">
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="image">File</label>
                                                        <input class="form-control" type="file" id="file" name="file">
                                                    </div>
                                                </div>
                                                @error('file')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input name="active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                                    </div>
                                                </div>
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
