@extends('layouts.admin')

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary mr-auto" onclick="window.location='{{ url('/master/addemployee') }}'">
                    <i class="fas fa-plus-circle"></i> Add New
                </button>
                <button type="button" id="allCount" class="btn btn-outline-success ml-2" disabled></button>
                <button type="button" id="activeCount" class="btn btn-outline-primary ml-2" disabled></button>
                <button type="button" id="inactiveCount" class="btn btn-outline-primary ml-2" disabled></button>
            </div>
            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif    
            <div class="card-body">
                <div class="table-responsive">
                    <table class="dataTables table table-hover col-12" id="employee-table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">NIK</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">Phone</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>    
    </div>
</div>

<script>
$(document).ready(function () {

    var table = $('#employee-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('employee.index') }}",
            type: 'GET',
            dataSrc: function (json) {
                // Update the total counts based on the fetched data
                allCount = json.recordsTotal;
                
                activeCount = json.data.reduce(function (count, row) {
                    return row.status === 1 ? count + 1 : count;
                }, 0);

                inactiveCount = json.data.reduce(function (count, row) {
                    return row.status === 0 ? count + 1 : count;
                }, 0);

                updateCounts();
                return json.data;
            }
        },
        columns: [
            { data: 'nik', name: 'nik' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            {
                data: 'status',
                name: 'status',
                render: function (data, type, row) {
                    return data === 1 ? 'Active' : 'Inactive';
                }
            },
            {
                data: 'nik',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return '<div class="btn-group" role="group">' +
                    '<a href="{{ url('employee') }}/' + row.nik + '/edit" class="edit btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>' +
                    '<span>&nbsp;</span>' +
                    '<button type="button" class="btn btn-danger btn-sm delete" data-nik="' + row.nik + '"><i class="fa-solid fa-trash-can"></i></button>' +
                    '</div>';
                }
            },
        ],
    });

    $('#employee-table').on('click', '.edit', function() {
        var url = $(this).attr('href');
        window.location.href = url;
    });

    $('#employee-table').on('click', '.delete', function() {
        var nik = $(this).data('nik');

        if (confirm('Apakah Anda yakin ingin menghapus data dengan NIK ' + nik + '?')) {
            $.ajax({
                type: 'DELETE',
                url: "{{ url('employees') }}/" + nik,
                data: {
                _token: '{{ csrf_token() }}', 
                },
                success: function(data) {
                    alert('Data berhasil dihapus');
                    table.ajax.reload();
                },
                error: function(error) {
                    console.error('Gagal menghapus data', error);
                }
            });
        }
    });
    function updateCounts() {
        $('#allCount').text('All (' + allCount + ')');
        $('#activeCount').text('Active (' + activeCount + ')');
        $('#inactiveCount').text('Inactive (' + inactiveCount + ')');
    }
});

</script>

<script>
    function redirectOnClick(url) {
        window.location.href = url;
    }
</script>
@endsection
