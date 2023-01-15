{{ Session::forget('selectedMenuBarType'); }}

@extends('layouts.app')

@section('title', 'Makku Frozen Food - Menu Bar')

@section('page-header', 'Menu Bar')
@section('page-desc', 'Menu bar master data')

@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="/admin/master/menubar" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('admin.master.menubar.store') }}" id="selectbox" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                    @csrf
                                    {{ csrf_field() }}
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

                                            <div class="col-6 mt-1">
                                                <div class="form-group">
                                                    <label for="refer">Refer</label>
                                                    <input type="text" id="refer" class="form-control"
                                                        name="refer" placeholder="Refer" required value="{{old('refer')}}">
                                                </div>
                                                @error('refer')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>
                                            
                                            <div id="refer-dropdown" class="col-6 mt-1" style="visibility: hidden;">
                                                <div class="form-group">
                                                    <input type="hidden" id="referData" name="referData" required value="{{ $productCategory }}"/>
                                                    <label for="productCategorySlug">Product Category Slug</label>
                                                    <select class="choices form-select" id="productCategorySlug" name="productCategorySlug">
                                                        @foreach($productCategory as $item)
                                                            <option value="{{ $item->slug }}">{{ $item->slug }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('parent')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-6 mt-1">
                                                <div class="form-group">
                                                    <input type="hidden" id="uname" name="uname" required/>
                                                    <label for="type">Type</label>
                                                    <select class="form-select dropdown" id="type"  name="type">
                                                        <option value="parent">Parent</option>
                                                        <option value="child">Child</option>
                                                        <option value="sub child">Sub Child</option>
                                                    </select>
                                                </div>
                                                @error('type')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div id="parent-dropdown" class="col-6 mt-1" style="visibility: hidden;">
                                                <div class="form-group">
                                                    <input type="hidden" id="parentData" name="parentData" required value="{{ $parent }}"/>
                                                    <label for="parent">Parent</label>
                                                    <select class="choices form-select" id="parent" name="parent">
                                                        {{-- <option value="" selected>No Parent</option> --}}
                                                        @foreach($parent as $item)
                                                            @if (session('selectedMenuBarType') == 'child')
                                                                @if ($item->type == 'parent')
                                                                    <option value="{{ $item->id }}">{{ $item->title_en }}</option>  
                                                                @endif
                                                            @elseif (session('selectedMenuBarType') == 'sub child')
                                                                @if ($item->type == 'child')
                                                                    <option value="{{ $item->id }}">{{ $item->title_en }}</option>  
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('parent')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="image">Image (Optional)</label>
                                                        <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-1">
                                                <div class="form-group">
                                                    <label for="orderNumber">Order Number</label>
                                                    <input type="text" id="is_active" class="form-control"
                                                        name="orderNumber" placeholder="Order Number" required value="{{old('orderNumber')}}">
                                                </div>
                                                @error('orderNumber')
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
<script src="/lte/assets/extensions/jquery/jquery.min.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#type').change(function() {
            var typeSelected = $('#type option:selected').val();
            var parentData = $('#parentData').val();
            
            if(typeSelected == 'parent') {
                $('#parent-dropdown').css("visibility", "hidden");
                $('#refer').removeAttr('disabled');
                $('#refer').val('');
                $('#refer-dropdown').css("visibility", "hidden");
            } else {
                $('#parent-dropdown').css("visibility", "visible");
            }
            
            $('#uname').val(parentData);
            // console.log($("#selectbox").serialize());
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '/set_type',
                data: $("#selectbox").serialize()
            })
            .done(function(data){
                // console.log(data);
                var parentData = jQuery.parseJSON($('#parentData').val());
                
                $('#parent').empty();
                for(var i in parentData) {
                    if(data == 'child') {
                        if(parentData[i].type == 'parent') {
                            // $('#parent').append('<option value = '+parentData[i].id+'>'+parentData[i].title_en+' ('+parentData[i].title_id+')'+'</option>');
                            $('#parent').append('<option value = '+parentData[i].id+'>'+parentData[i].title_en+' ('+parentData[i].title_id+')'+'</option>');
                        }
                    } else if(data == 'sub child') {
                        if(parentData[i].type == 'child') {
                            $('#parent').append('<option value = '+parentData[i].id+'>'+parentData[i].title_en+'</option>');
                        }
                    }
                }

                if(data == 'child' || data == 'sub child') {
                    $('#parent').trigger("change");
                    var isHidden = $("#refer-dropdown").css('visibility');
                    if (isHidden == 'visible') {
                        $('#productCategorySlug').trigger("change");
                    }
                }
            })
            .fail(function() {
                alert( "Posting failed." );
            });
            return false;
        });

        $('#parent').change(function() {
            alert('WKWK');
            var parentSelectedId = $('#parent option:selected').val();
            var parentData = jQuery.parseJSON($('#parentData').val());
            console.log(parentData);
            
            var strParentSelected = '';
            var tempStrParent = '';
            var isOurProduct = false;
            for(var i in parentData) {
                if(parentData[i].id == parentSelectedId) {
                    strParentSelected = parentData[i].title_en;
                    tempStrParent = parentData[i].parent;

                    for(var j in parentData) {
                        if(parentData[j].id == tempStrParent) {
                            if((parentData[j].title_en).toLowerCase() == 'our company') {
                                isOurProduct = true;
                                break;
                            }
                        }
                    }
                    break;
                }
            }
            console.log('tes '+tempStrParent);

            if(strParentSelected.toLowerCase() == 'our company' || isOurProduct) {
                $('#refer').attr('disabled','disabled');
                $('#refer').val('our-product/');
                $('#refer-dropdown').css("visibility", "visible");
                
            } else {
                $('#refer').removeAttr('disabled');
                $('#refer').val('');
                $('#refer-dropdown').css("visibility", "hidden");
            }

            $('#parent').trigger("change");
            var isHidden = $("#refer-dropdown").css('visibility');
            alert(isHidden);
            if (isHidden == 'visible') {
                
                $('#productCategorySlug').trigger("change");
            }
        });

        $('#productCategorySlug').change(function() {
            var slugSelected = $('#productCategorySlug option:selected').val();
            $("#refer").val(function() {
                return 'our-product/' + slugSelected;
            });
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