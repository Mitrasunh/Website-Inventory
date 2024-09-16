@extends('layouts.admin')

@section('main-content')
@php
    $currentPageHeading = 'Add New Employee';
@endphp
<div class="card mb-4">
    <div class="card-header">
        <button ctype="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('master/employee') }}')"> BACK</button>
    </div>
    <div class="card-body">
        <form action="{{ url('employees') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="txtnik" class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtnik') is-invalid @enderror" id="txtnik" name="txtnik" value="{{ old('txtnik') }}">
                    @error('txtnik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtusername" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtusername') is-invalid @enderror" id="txtusername" name="txtusername" value="{{ old('txtusername') }}">
                    @error('txtusername')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtemail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('txtemail') is-invalid @enderror" id="txtemail" name="txtemail" value="{{ old('txtemail') }}">
                    @error('txtemail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtphone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="status" class="form-control @error('txtphone') is-invalid @enderror" id="txtphone" name="txtphone" value="{{ old('txtphone') }}">
                    @error('txtphone')
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