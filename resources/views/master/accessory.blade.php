@extends('layouts.admin')

@section('main-content')
   
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header  d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary mr-auto" onclick="window.location='{{ url('master/addaccessory') }}'">
                    <i class="fas fa-plus-circle"></i> Add new
                </button>
                @foreach ($countByCategory as $category => $totalQty)
                    <button type="button" class="btn btn-outline-primary ml-2" id="{{ $category }}Count" disabled>{{ $category }} ({{ $totalQty }})</button>
                @endforeach
            </div>
            @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif    
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="accessory-table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Model Number</th>
                                <th class="text-nowrap">Category</th>
                                <th class="text-nowrap">Supplier</th>
                                <th class="text-nowrap">Purchase</th>
                                <th class="text-nowrap">Qty</th>
                                <th class="text-nowrap">Notes</th>
                                <th class="text-nowrap">Image</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#accessory-table').DataTable({
            responsive: true, 
            processing: true,
            serverSide: true,
            ajax: "{{ route('accessories.index') }}",
            columns: [
                { data: 'modelNumber', name: 'modelNumber' },
                { data: 'category', name: 'category' },
                { data: 'supplier', name: 'supplier' },
                { data: 'purchase', name: 'purchase' },
                { data: 'qty', name: 'qty' },
                { data: 'notes', name: 'notes' },
                { data: 'image', name: 'image' },
                {
                    data: 'modelNumber',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<a href="{{ url('accessory') }}/' + row.modelNumber + '/edit" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)"  class="delete btn btn-danger btn-sm"  data-id="' + row.modelNumber + '">Delete</a>';
                    }
                },
            ]
        });
        
        $('#accessory-table').on('click', '.edit', function() {
            var url = $(this).attr('href');
            window.location.href = url;
        });

        $('#accessory-table').on('click', '.delete', function() {
            var modelNumber = $(this).data('id');

            if (confirm('Apakah Anda yakin ingin menghapus data dengan ID ' + modelNumber + '?')) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ url('accessories') }}/" + modelNumber,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data); 
                        alert('Data berhasil dihapus');
                        table.ajax.reload();
                    },
                    error: function(error) {
                        console.error('Gagal menghapus data', error);
                    }
                });
            }
        });

    });

    function redirectOnClick(url) {
        window.location.href = url;
    }
</script>

@endsection
