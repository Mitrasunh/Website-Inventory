@extends('layouts.admin')

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('userAccessory.create') }}'">
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
                    <table class="dataTables table table-hover col-12" id="userAccessory-table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">NIK</th>
                                <th class="text-nowrap">User</th>
                                <th class="text-nowrap">Model Number</th>
                                <th class="text-nowrap">Category</th>
                                <th class="text-nowrap">Date</th>
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
    var table = $('#userAccessory-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('userAccessory.index') }}",
        columns: [
            { data: 'nik', name: 'nik' }, 
            { data: 'username', name: 'username' },
            { data: 'modelNumber', name: 'modelNumber' }, 
            { data: 'category', name: 'category' }, 
            { data: 'startDate', name: 'startDate' },
            {
                data: 'nik',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return '<div class="btn-group" role="group">' +
                    '<a href="{{ url('userAccessory') }}/' + (row.nik ? row.nik + '/detail' : 'detail') + '" class="detail btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></a>' +
                    '<span>&nbsp;</span>' +
                    '<button type="button" class="btn btn-danger btn-sm delete" data-id="' + row.nik + '"><i class="fa-solid fa-trash-can"></i></button>' +
                        '</div>';
                }
            },
        ],
        initComplete: function () {
            var allCount = table.rows().count();
            $('#allCount').text('All (' + allCount + ')');
        }
    });

    $('#userAccessory-table').on('click', '.detail', function() {
        var url = $(this).attr('href');
        window.location.href = url;
    });


    $('#userAccessory-table').on('click', '.delete', function () {
        var nik = $(this).data('id');

        if (confirm('Apakah Anda yakin ingin menghapus data dengan ID ' + nik + '?')) {
            $.ajax({
                type: 'POST',
                url: "{{ route('userAsset.destroy', ':nik') }}".replace(':nik', nik),
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
