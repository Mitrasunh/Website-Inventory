@extends('layouts.admin')
@php
    $currentPageHeading = 'Add New Asset';
@endphp
@section('main-content')
<div class="card mb-4">
    <div class="card-header">
        <button ctype="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('master/asset') }}')"> BACK</button>
    </div>
    <div class="card-body">
        <form action="{{ route('assets.store') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="idAsset" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('idAsset') is-invalid @enderror" id="idAsset" name="txtidAsset" value="{{ old('idAsset') }}">
                    @error('idAsset')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtname" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtname') is-invalid @enderror" id="txtname" name="txtname" value="{{ old('txtname') }}">
                    @error('txtname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtbrand" class="col-sm-2 col-form-label">Brand</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtbrand') is-invalid @enderror" id="txtbrand" name="txtbrand" value="{{ old('txtbrand') }}">
                    @error('txtbrand')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txttype" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txttype') is-invalid @enderror" id="txttype" name="txttype" value="{{ old('txttype') }}">
                    @error('txttype')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtprocessor" class="col-sm-2 col-form-label">Processor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtprocessor') is-invalid @enderror" id="txtprocessor" name="txtprocessor" value="{{ old('txtprocessor') }}">
                    @error('txtprocessor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtramCapacity" class="col-sm-2 col-form-label">RAM Capacity</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtramCapacity') is-invalid @enderror" id="txtramCapacity" name="txtramCapacity" value="{{ old('txtramCapacity') }}">
                    @error('txtramCapacity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtstorage" class="col-sm-2 col-form-label">Storage</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtstorage') is-invalid @enderror" id="txtstorage" name="txtstorage" value="{{ old('txtstorage') }}">
                    @error('txtstorage')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtoperatingSystem" class="col-sm-2 col-form-label">Operating System</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtoperatingSystem') is-invalid @enderror" id="txtoperatingSystem" name="txtoperatingSystem" value="{{ old('txtoperatingSystem') }}">
                    @error('txtoperatingSystem')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtsupplier" class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtsupplier') is-invalid @enderror" id="txtsupplier" name="txtsupplier" value="{{ old('txtsupplier') }}">
                    @error('txtsupplier')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtipAddress1" class="col-sm-2 col-form-label">IP Address 1</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtipAddress1') is-invalid @enderror" id="txtipAddress1" name="txtipAddress1" value="{{ old('txtipAddress1') }}">
                    @error('txtipAddress1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtipAddress2" class="col-sm-2 col-form-label">IP Address 2</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtipAddress2') is-invalid @enderror" id="txtipAddress2" name="txtipAddress2" value="{{ old('txtipAddress2') }}">
                    @error('txtipAddress2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtmacAddress" class="col-sm-2 col-form-label">Mac Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtmacAddress') is-invalid @enderror" id="txtmacAddress" name="txtmacAddress" value="{{ old('txtmacAddress') }}">
                    @error('txtmacAddress')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtantivirus" class="col-sm-2 col-form-label">Antivirus</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtantivirus') is-invalid @enderror" id="txtantivirus" name="txtantivirus" value="{{ old('txtantivirus') }}">
                    @error('txtantivirus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtbatteryHealth" class="col-sm-2 col-form-label">Battery</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtbatteryHealth') is-invalid @enderror" id="txtbatteryHealth" name="txtbatteryHealth" value="{{ old('txtbatteryHealth') }}">
                    @error('txtbatteryHealth')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtserialNumber" class="col-sm-2 col-form-label">Serial Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtserialNumber') is-invalid @enderror" id="txtserialNumber" name="txtserialNumber" value="{{ old('txtserialNumber') }}">
                    @error('txtserialNumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtpurchase" class="col-sm-2 col-form-label">Purchase</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control @error('txtpurchase') is-invalid @enderror" id="txtpurchase" name="txtpurchase" value="{{ old('txtpurchase') }}">
                    @error('txtpurchase')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>                
            </div>
           
            <div class="mb-3 row">
                <label for="txtnotes" class="col-sm-2 col-form-label">Notes</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtnotes') is-invalid @enderror" id="txtnotes" name="txtnotes" value="{{ old('txtnotes') }}">
                    @error('txtnotes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtimage_path" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtimage_path') is-invalid @enderror" id="txtimage_path" name="txtimage_path" value="{{ old('txtimage_path') }}">
                    @error('txtimage_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-center">
            <button class="btn btn-md btn-success" type="submit"> SAVE</button>
            </div>
        </form>
    </div>   
</div>

<script>
    function redirectOnClick(url) {
    window.location.href = url;
    }
</script>

@endsection