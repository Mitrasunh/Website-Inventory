@extends('layouts.admin')
@php
    $currentPageHeading = 'Edit Accessory';
@endphp
@section('main-content')
<div class="card mb-4">
    <div class="card-header">
        <button ctype="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('master/accessory') }}')"> BACK</button>
    </div>
    <div class="card-body">
        <form action="{{ route('accessories.update', $accessory->modelNumber) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="txtmodelNumber" class="col-sm-2 col-form-label">Model Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtmodelNumber') is-invalid @enderror" id="txtmodelNumber" name="txtmodelNumber" value="{{ $accessory-> modelNumber }}">
                    @error('txtmodelNumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtcategory" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtcategory') is-invalid @enderror" id="txtcategory" name="txtcategory" value="{{ $accessory->category }}">
                    @error('txtcategory')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> <div class="mb-3 row">
                <label for="txtsupplier" class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtsupplier') is-invalid @enderror" id="txtsupplier" name="txtsupplier" value="{{ $accessory->supplier }}">
                    @error('txtsupplier')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtpurchase" class="col-sm-2 col-form-label">Purchase</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control @error('txtpurchase') is-invalid @enderror" id="txtpurchase" name="txtpurchase" value="{{ $accessory->purchase }}">
                    @error('txtpurchase')
                        <div class="invalid-feedback">
                                {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtqty" class="col-sm-2 col-form-label">Qty</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('txtqty') is-invalid @enderror" id="txtqty" name="txtqty" value="{{ $accessory->qty }}">
                    @error('txtqty')
                        <div class="invalid-feedback">
                                {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtnotes" class="col-sm-2 col-form-label">Notes</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtnotes') is-invalid @enderror" id="txtnotes" name="txtnotes" value="{{ $accessory->notes }}">
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
                    <input type="text" class="form-control @error('txtimage_path') is-invalid @enderror" id="txtimage_path" name="txtimage_path" value="{{ $accessory->image_path }}">
                    @error('txtimage_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-md btn-success" type="submit"> UPDATE</button>
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