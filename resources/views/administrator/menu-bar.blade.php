@extends('layouts.app')

@section('title', 'Makku Frozen Food - Menu Bar')

@section('vendorCSS')
<link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
@endsection

@section('page-header', 'Menu Bar')
@section('page-desc', 'Menu bar master data')

@section('content')
@include('sweetalert::alert')

<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="/admin/master/menubar/create" class="btn btn-outline-primary">Add Data</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title - EN</th>
                        <th>Title - ID</th>
                        <th>Refer</th>
                        <th>Type</th>
                        <th>Parent</th>
                        <th>Image</th>
                        <th>Order Number</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @foreach ($menuBar as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->title_en}}</td>
                            <td>{{$item->title_id}}</td>
                            <td>{{$item->refer}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->parent}}</td>
                            <td><img src="/{{$item->image}}" alt="" class="img-fluid" width="100"></td>
                            <td>{{$item->orderNumber}}</td>
                            @if ($item->active=='1')
                                <td><span class="badge bg-success">Active</span></td>
                            @else
                                <td><span class="badge bg-danger">Inactive</span></td>
                            @endif                                
                            <td>
                                <a href="{{ route('admin.master.menubar.edit', $item->id) }}" class="btn icon btn-sm btn-primary d-inline-block m-1" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.master.menubar.destroy', $item->id) }}" method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip" title="Delete">
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

<script>
    @if($message = session('error'))
        Swal.fire(
            'Data with the same Order Number already exists!',
            'The existing data is <b>{{ $message }}</b>',
            'error'
        )
    @endif
</script>

{{-- <script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script> --}}

@endsection