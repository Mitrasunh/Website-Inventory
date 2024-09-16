@extends('layouts.admin')

@section('main-content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary mr-auto" onclick="window.location='{{ url('/master/addasset') }}'">
                    <i class="fas fa-plus-circle"></i> Add new asset
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
                    <table class="table table-hover" id="asset-table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">ID</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Brand</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-nowrap">Processor</th>
                                <th class="text-nowrap">RAM Capacity</th>
                                <th class="text-nowrap">Storage</th>
                                <th class="text-nowrap">OS</th>
                                <th class="text-nowrap">Supplier</th>
                                <th class="text-nowrap">IP Address 1</th>
                                <th class="text-nowrap">IP Address 2</th>
                                <th class="text-nowrap">Mac Address</th>
                                <th class="text-nowrap">Antivirus</th>
                                <th class="text-nowrap">Battery</th>
                                <th class="text-nowrap">Serial Number</th>
                                <th class="text-nowrap">Purchase</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Notes</th>
                                <th class="text-nowrap">Image</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table content will be dynamically loaded by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
   $(document).ready(function () {
    var table = $('#asset-table').DataTable({
        responsive: true, // Enable responsiveness
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('asset.index') }}",
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
            { data: 'idAsset', name: 'idAsset' },
            { data: 'name', name: 'name' },
            { data: 'brand', name: 'brand' },
            { data: 'type', name: 'type' },
            { data: 'processor', name: 'processor' },
            { data: 'ramCapacity', name: 'ramCapacity' },
            { data: 'storage', name: 'storage' },
            { data: 'operatingSystem', name: 'operatingSystem' },
            { data: 'supplier', name: 'supplier' },
            { data: 'ipAddress1', name: 'ipAddress1' },
            { data: 'ipAddress2', name: 'ipAddress2' },
            { data: 'macAddress', name: 'macAddress' },
            { data: 'antivirus', name: 'antivirus' },
            { data: 'batteryHealth', name: 'batteryHealth' },
            { data: 'serialNumber', name: 'serialNumber' },
            { data: 'purchase', name: 'purchase' },
            {
                data: 'status',
                    name: 'status',
                    render: function (data, type, row) {
                        return data === 1 ? 'Active' : 'Inactive';
                    }
                },
            { data: 'notes', name: 'notes' },
            { data: 'image_path', name: 'image_path' },
            
            {
                data: 'idAsset',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return '<div class="btn-group" role="group">' +
                    '<a href="{{ url('asset') }}/' + row.idAsset + '/edit" class="edit btn btn-success btn-sm">Edit</a>' +
                    '<span>&nbsp;</span>' +
                    '<button type="button" class="btn btn-danger btn-sm delete" data-id="' + row.idAsset + '">Delete</button>' +
                    '</div>';
                }
            },
        ],
       initComplete: function () {
            $('#allCount').text('All (' + allCount + ')');
            $('#activeCount').text('Active (' + activeCount + ')');
            $('#inactiveCount').text('Inactive (' + inactiveCount + ')');
        }
    });

    $('#asset-table').on('click', '.edit', function() {
        var url = $(this).attr('href');
        window.location.href = url;
    });

    $('#asset-table').on('click', '.delete', function() {
        var idAsset = $(this).data('id');

        if (confirm('Apakah Anda yakin ingin menghapus data dengan ID ' + idAsset + '?')) {
            $.ajax({
                type: 'DELETE',
                url: "{{ url('assets') }}/" + idAsset,
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
