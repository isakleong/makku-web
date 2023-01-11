@extends('layouts.app')

@section('title', 'Makku Frozen Food - Testimonial')

@section('vendorCSS')
<link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
@endsection

@section('page-header', 'Testimonial')
@section('page-desc', 'Testimonial master data')

@section('content')
@include('sweetalert::alert')

<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="/admin/testimonial/create" class="btn btn-outline-primary">Add Data</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped dt-responsive" id="table1" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Content - EN</th>
                        <th>Content - ID</th>
                        <th>Author</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @foreach ($testimonial as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->content_en}}</td>
                            <td>{{$item->content_id}}</td>
                            <td>{{$item->author}}</td>
                            @if ($item->active=='1')
                                <td><span class="badge bg-success">Active</span></td>
                            @else
                                <td><span class="badge bg-danger">Inactive</span></td>
                            @endif
                            <td>
                                <a href="{{ route('admin.testimonial.edit', $item->id) }}" class="btn icon btn-sm btn-primary d-inline-block m-1" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.testimonial.destroy', $item->id) }}" method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip" title="Delete">
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
                event.preventDefault();

                var form =  $(this).closest("form");
                var name = $(this).data("name");
                
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