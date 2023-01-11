@extends('layouts.app')

@section('title', 'Makku Frozen Food - Product')

@section('vendorCSS')
    <link rel="stylesheet" href="/lte/assets/extensions/choices.js/public/assets/styles/choices.css">
@endsection

@section('page-header', 'Product')
@section('page-desc', 'Product master data')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="/admin/product/item" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('admin.product.item.update', $item->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name_en">Name - EN</label>
                                                    <input type="text" id="name_en" class="form-control"
                                                        name="name_en" placeholder="Name (English)" value="{{$item->name_en}}">
                                                </div>
                                                @error('name_en')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="name_id">Name - ID</label>
                                                    <input type="text" id="name_id" class="form-control"
                                                        name="name_id" placeholder="Name (Indonesia)" value="{{$item->name_id}}">
                                                </div>
                                                @error('name_id')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" id="slug" class="form-control"
                                                        name="slug" placeholder="Slug" value="{{$item->slug}}">
                                                </div>
                                                @error('slug')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-1">
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
                                                    <label for="brandID">Brand</label>
                                                    <select class="choices form-select" id="brandID"  name="brandID">
                                                        @foreach($brand as $row)
                                                            @if ($row->name == $brandSelected->name)
                                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                                            @else
                                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('brandID')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="image">Image (Optional)</label>
                                                        @if ($item->image != "")
                                                            <img src="/{{$item->image}}" alt="" class="img-preview img-fluid mb-3 mt-3 col-4 d-block"> 
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

                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input name="active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $item->active=='1' ? 'checked' : '' }}>
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

<script src="/lte/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="/lte/assets/js/pages/form-element-select.js"></script>

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