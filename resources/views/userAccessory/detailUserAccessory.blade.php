@extends('layouts.admin')
@php
    $currentPageHeading =($detailUserAccessories->isNotEmpty() ? $detailUserAccessories->first()->username : '') . " Detail Accessories "  ;
@endphp

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex mb-3 justify-content-between align-items-center">
                <button type="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('userAccessory/userAccessory') }}')"> BACK</button>
                <button type="button" id="activeCount" class="btn btn-outline-primary ml-2" disabled></button>
            </div>
            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="dataTables table table-hover col-12" id="userAccessoryDetail-table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Model Number</th>
                                <th class="text-nowrap">Category</th>
                                <th class="text-nowrap">Date</th>
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
    var table = $('#userAccessoryDetail-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        data: {!! json_encode($detailUserAccessories) !!},
        columns: [
            { data: 'modelNumber', name: 'modelNumber' },
            { data: 'category', name: 'category' },
            { data: 'startDate', name: 'startDate' },
            {
                data: 'status',
                name: 'status',
                render: function (data, type, row) {
                    return data === 1 ? 'In Use' : 'Returned';
                }
            },
            {
                data: 'modelNumber',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return '<div class="btn-group" role="group">' +
                        '<button type="button" class="btn btn-danger btn-sm delete" data-id="' + row.modelNumber + '"><i class="fas fa-trash"></i></button>' +
                        '</div>';
                }
            },
        ],
    });

    var activeCount = {!! json_encode($detailUserAccessories->where('status', 1)->count()) !!};
    $('#activeCount').text('Accesories (' + activeCount + ')');
        
    $('#userAccessoryDetail-table').on('click', '.delete', function () {
        var modelNumber = $(this).data('id');

        if (confirm('Apakah Anda yakin ingin menghapus data dengan Model Number ' + modelNumber + '?')) {
            $.ajax({
                type: 'POST',
                url: "{{ route('userAccessory.destroy', '') }}/" + modelNumber,
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    console.log('Data berhasil dihapus:', data);
                    if (data && data.message && data.message === 'Data berhasil dihapus') {
                        alert('Data berhasil dihapus');
                        table.ajax.reload();
                    } else {
                        alert('Gagal menghapus data. Response tidak sesuai.');
                    }
                },
                error: function (error) {
                    console.error('Gagal menghapus data:', error);
                    if (error.responseJSON && error.responseJSON.message) {
                        alert('Gagal menghapus data. ' + error.responseJSON.message);
                    } else {
                        alert('Gagal menghapus data. Silakan coba lagi.');
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
