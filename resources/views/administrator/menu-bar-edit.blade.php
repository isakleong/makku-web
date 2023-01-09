{{ Session::forget('selectedMenuBarType'); }}

@extends('layouts.app')

@section('title', 'Makku Frozen Food - Menu Bar')

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
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/admin/product/catalogue">Catalogue</a>
                </li>
                <li class="submenu-item ">
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
            class="sidebar-item  has-sub">
            <a href="" class='sidebar-link'>
                <i class="bi bi-newspaper"></i>
                <span>News</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/admin/news/category">Category</a>
                </li>
                {{-- <li class="submenu-item ">
                    <a href="/admin/news/tag">Tag</a>
                </li> --}}
                <li class="submenu-item ">
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
            class="sidebar-item  has-sub active">
            <a href="/master" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Master</span>
            </a>
            <ul class="submenu active">
                <li class="submenu-item active">
                    <a href="/admin/master/menubar">Menu Bar</a>
                </li>
                <li class="submenu-item ">
                    <a href="/admin/master/producthighlight">Product Highlight</a>
                </li>
                <li class="submenu-item ">
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
                <h3>Menu Bar</h3>
                <p class="text-subtitle text-muted">Navbar master data in Homepage</p>
            </div>
        </div>
    </div>
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
                                    <form action="{{ route('admin.master.menubar.update', $menubar->id) }}" id="selectbox" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                        @csrf
                                        {{ csrf_field() }}
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title_en">Title - EN</label>
                                                        <input type="text" id="title_en" class="form-control"
                                                            name="title_en" placeholder="Title (English)" value="{{$menubar->title_en}}">
                                                    </div>
                                                    @error('title_en')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="title_id">Title - ID</label>
                                                        <input type="text" id="title_id" class="form-control"
                                                            name="title_id" placeholder="Title (Indonesia)" value="{{$menubar->title_id}}">
                                                    </div>
                                                    @error('title_id')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="refer">Refer</label>
                                                        <input type="text" id="refer" class="form-control"
                                                            name="refer" placeholder="Refer" value="{{$menubar->refer}}">
                                                    </div>
                                                    @error('refer')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-6 mt-1">
                                                    <div class="form-group">
                                                        <input type="hidden" id="uname" name="uname" required/>
                                                        <label for="type">Type</label>
                                                        <select class="form-select dropdown" id="type"  name="type">
                                                            @if (strtolower($menubar->type) == 'parent')
                                                                <option value="parent" selected>Parent</option>
                                                            @else
                                                                <option value="parent">Parent</option>
                                                            @endif

                                                            @if (strtolower($menubar->type) == 'child')
                                                                <option value="child" selected>Child</option>
                                                            @else
                                                                <option value="child">Child</option>
                                                            @endif

                                                            @if (strtolower($menubar->type) == 'sub child')
                                                                <option value="sub child" selected>Sub Child</option>
                                                            @else
                                                                <option value="sub child">Sub Child</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @error('type')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                @if (strtolower($menubar->type) == 'parent')
                                                    <div id="parent-dropdown" class="col-6 mt-1" style="visibility: hidden;">
                                                @else
                                                    <div id="parent-dropdown" class="col-6 mt-1">
                                                @endif
                                                    <div class="form-group">
                                                        <input type="hidden" id="parentData" name="parentData" required value="{{ $parent }}"/>
                                                        <label for="parent">Parent</label>
                                                        <select class="choices form-select" id="parent"  name="parent">
                                                            {{-- <option value="" selected>No Parent</option> --}}
                                                            @foreach($parent as $item)
                                                                @if (session('selectedMenuBarType') == 'child')
                                                                    @if ($item->type == 'parent')
                                                                        @if (strtolower($item->id) == $menubar->parent)
                                                                            <option value="{{ $item->id }}" selected>{{$item->title_en}}</option>
                                                                        @else
                                                                            <option value="{{ $item->id }}">{{$item->title_en}}</option>
                                                                        @endif
                                                                    @endif
                                                                @elseif (session('selectedMenuBarType') == 'sub child')
                                                                    @if ($item->type == 'child')
                                                                        @if (strtolower($item->id) == $menubar->parent)
                                                                            <option value="{{ $item->id }}" selected>{{$item->title_en}}</option>
                                                                        @else
                                                                            <option value="{{ $item->id }}">{{$item->title_en}}</option>
                                                                        @endif
                                                                    @endif

                                                                @else
                                                                    {{-- first load --}}
                                                                    @if ($menubar->type == 'child')
                                                                        @if ($item->type == 'parent')
                                                                            @if (strtolower($item->id) == $menubar->parent)
                                                                                <option value="{{ $item->id }}" selected>{{$item->title_en}}</option>
                                                                            @else
                                                                                <option value="{{ $item->id }}">{{$item->title_en}}</option>
                                                                            @endif
                                                                        @endif
                                                                    @elseif ($menubar->type == 'sub child')
                                                                        @if ($item->type == 'child')
                                                                            @if (strtolower($item->id) == $menubar->parent)
                                                                                <option value="{{ $item->id }}" selected>{{$item->title_en}}</option>
                                                                            @else
                                                                                <option value="{{ $item->id }}">{{$item->title_en}}</option>
                                                                            @endif
                                                                        @endif
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
                                                            @if ($menubar->image != "")
                                                                <img src="/{{$menubar->image}}" alt="" class="img-preview img-fluid mb-3 mt-3 col-4 d-block"> 
                                                                <div class="form-check">
                                                                    <div class="checkbox">
                                                                        <input name="discard" type="checkbox" id="checkbox3" class="form-check-input"/>
                                                                        <label for="checkbox3">Discard Old Image</label>
                                                                    </div>
                                                                </div>
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

                                                <div class="col-12 mt-1">
                                                    <div class="form-group">
                                                        <label for="orderNumber">Order Number</label>
                                                        <input type="text" id="orderNumber" class="form-control"
                                                            name="orderNumber" placeholder="Order Number" value="{{$menubar->orderNumber}}">
                                                    </div>
                                                    @error('orderNumber')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="form-check form-switch">
                                                            <input name="active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $menubar->active=='1' ? 'checked' : '' }}>
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
</div>
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
            } else {
                $('#parent-dropdown').css("visibility", "visible");
            }
            
            $('#uname').val(parentData);
            console.log($("#selectbox").serialize());
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'PUT',
                url: '/set_type',
                data: $("#selectbox").serialize()
            })
            .done(function(data){
                console.log(data);
                var parentData = jQuery.parseJSON($('#parentData').val());
                
                $('#parent').empty();
                for(var i in parentData) {
                    if(data == 'child') {
                        if(parentData[i].type == 'parent') {
                            $('#parent').append('<option value = '+parentData[i].id+'>'+parentData[i].title_en+'</option>');
                        }
                    } else if(data == 'sub child') {
                        if(parentData[i].type == 'child') {
                            $('#parent').append('<option value = '+parentData[i].id+'>'+parentData[i].title_en+'</option>');
                        }
                    }
                }
            })
            .fail(function() {
                alert( "Posting failed." );
            });
            return false;
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

@endsection