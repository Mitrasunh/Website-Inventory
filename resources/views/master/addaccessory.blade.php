@extends('layouts.admin')
@php
    $currentPageHeading = 'Add New Accessory';
@endphp
@section('main-content')
<div class="card mb-4">
    <div class="card-header">
        <button ctype="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('master/accessory') }}')"> BACK</button>
    </div>
    <div class="card-body">
        <form action="{{ url('accessories') }}" method="POST">
            @csrf
            {{-- <div class="mb-3 row">
                <label for="txtidAcc" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtidAcc') is-invalid @enderror" id="txtidAcc" name="txtidAcc" value="{{ old('txtidAcc') }}">
                    @error('txtidAcc')
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
            </div> --}}
            <div class="mb-3 row">
                <label for="txtmodelNumber" class="col-sm-2 col-form-label">Model Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtmodelNumber') is-invalid @enderror" id="txtmodelNumber" name="txtmodelNumber" value="{{ old('txtmodelNumber') }}">
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
                    <input type="text" class="form-control @error('txtcategory') is-invalid @enderror" id="txtcategory" name="txtcategory" value="{{ old('txtcategory') }}">
                    @error('txtcategory')
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
                <label for="txtqty" class="col-sm-2 col-form-label">Qty</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('txtqty') is-invalid @enderror" id="txtqty" name="txtqty" value="{{ old('txtqty') }}">
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
                    <input type="text" class="form-control @error('txtnotes') is-invalid @enderror" id="txtnotes" name="txtnotes" value="{{ old('txtnotes') }}">
                    @error('txtnotes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="txtimage" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtimage') is-invalid @enderror" id="txtimage" name="txtimage" value="{{ old('txtimage') }}">
                    @error('txtimage')
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
  <script>
    function redirectOnClick(url) {
        window.location.href = url;
    }
  </script>
</div>
@endsection