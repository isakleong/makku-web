@extends('layouts.app')

@section('title', 'Makku Frozen Food - Product Brand')

@section('vendorCSS')
<link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
@endsection

@section('content')
@include('sweetalert::alert')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Product Brand</h3>
                <p class="text-subtitle text-muted">Product brand</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="buttons">
                    <a href="/admin/product/brand/create" class="btn btn-outline-primary">Add Data</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($brand as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->slug}}</td>
                                @if ($item->active=='1')
                                    <td><span class="badge bg-success">Active</span></td>
                                @else
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('admin.product.brand.edit', $item->id) }}" class="btn icon btn-sm btn-primary d-inline-block m-1" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.product.brand.destroy', $item->id) }}" method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip" title="Delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn icon btn-sm btn-danger show_confirm"><i class="bi bi-x"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection

@section('vendorScript')
<script type="text/javascript" src="/vendor/datatable/js/datatables.min.js"></script>

<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#table1').DataTable({
            responsive: true
        });

        const registerDeleteItemHandlers = () => {
            $('.show_confirm').click(function(event) {
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                Swal.fire({
                title: 'Delete the data?',
                text: "If you delete this, it will be gone forever.",
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'Yes, delete',
                denyButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });
        };

        registerDeleteItemHandlers();

        $("#table1").on("draw.dt", function () {
            registerDeleteItemHandlers();
        });

        table.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
            // console.log('Details for row '+row.index()+' '+(showHide ? 'shown' : 'hidden'));
            registerDeleteItemHandlers();
        });
    });
</script>

@endsection