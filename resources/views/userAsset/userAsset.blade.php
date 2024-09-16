@extends('layouts.admin')

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('userAsset.create') }}'">
                    <i class="fas fa-plus-circle"></i> Add New
                </button>
                <button type="button" id="allCount" class="btn btn-outline-success ml-2" disabled></button>
            </div>
            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="dataTables table table-hover col-12" id="userAsset-table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">ID Asset</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Brand</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">User</th>
                                <th class="text-nowrap">Start Date</th>
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
    var table = $('#userAsset-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('userAsset.index') }}",
        columns: [
            { data: 'idAsset', name: 'idAsset' }, 
            { data: 'name', name: 'name' }, 
            { data: 'brand', name: 'brand' }, 
            { data: 'type', name: 'type' },
            {
                data: 'status',
                name: 'status',
                render: function (data, type, row) {
                    return data === 1 ? 'Active' : 'Inactive';
                }
            },
            { data: 'username', name: 'username' }, 
            { data: 'startDate', name: 'startDate' },
            {
                data: 'idAsset',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return '<div class="btn-group" role="group">' +
                        '<button type="button" class="btn btn-danger btn-sm delete" data-id="' + row.idAsset + '"><i class="fa-solid fa-trash-can"></i></button>' +
                        '</div>';
                }
            },
        ],
        initComplete: function () {
            var allCount = table.rows().count();
            $('#allCount').text('All (' + allCount + ')');
        }
    });

    $('#userAsset-table').on('click', '.delete', function () {
        var idAsset = $(this).data('id');

        if (confirm('Apakah Anda yakin ingin menghapus data dengan ID ' + idAsset + '?')) {
            $.ajax({
                type: 'POST',
                url: "{{ route('userAsset.destroy', ':idAsset') }}".replace(':idAsset', idAsset),
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    console.log('Data berhasil diubah:', data);
                    if (data && data.message && data.message === 'Data berhasil diubah') {
                        alert('Data berhasil diubah');
                        table.ajax.reload();
                    } else {
                        alert('Gagal mengubah data. Response tidak sesuai.');
                    }
                },
                error: function (error) {
                    console.error('Gagal mengubah data:', error);
                    if (error.responseJSON && error.responseJSON.message) {
                        alert('Gagal mengubah data. ' + error.responseJSON.message);
                    } else {
                        alert('Gagal mengubah data. Silakan coba lagi.');
                    }
                }
            });
        }
    });
});
</script>

<script>
    function redirectOnClick(url) {
        window.location.href = url;
    }
</script>
@endsection
