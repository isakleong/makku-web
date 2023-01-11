@extends('layouts.app')

@section('title', 'Makku Frozen Food - Partnership')

@section('vendorCSS')
<link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
@endsection

@section('page-header', 'Partnership')
@section('page-desc', 'Partnership master data')

@section('content')
@include('sweetalert::alert')

<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="/admin/partnership/create" class="btn btn-outline-primary">Add Data</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Logo</th>
                        <th>Address</th>
                        <th>Instagram</th>
                        <th>Whatsapp</th>
                        <th>Phone</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @foreach ($partnership as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->name}}</td>
                            <td><img src="/{{$item->image}}" alt="" class="img-fluid" width="100"></td>
                            <td><img src="/{{$item->logo}}" alt="" class="img-fluid" width="100"></td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->instagram}}</td>
                            <td>{{$item->whatsapp}}</td>
                            <td>{{$item->phoneNo}}</td>
                            @if ($item->active=='1')
                                <td><span class="badge bg-success">Active</span></td>
                            @else
                                <td><span class="badge bg-danger">Inactive</span></td>
                            @endif
                            <td>
                                <a href="{{ route('admin.partnership.edit', $item->id) }}" class="btn icon btn-sm btn-primary d-inline-block m-1" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.partnership.destroy', $item->id) }}" method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip" title="Delete">
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