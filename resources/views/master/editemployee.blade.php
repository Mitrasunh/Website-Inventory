@extends('layouts.admin')
@php
    $currentPageHeading = 'Edit Employee';
@endphp
@section('main-content')
<div class="card mb-4">
    <div class="card-header">
        <button ctype="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('master/employee') }}')"> BACK</button>
    </div>
    <div class="card-body">
        <form action="{{ route('employees.update', $employee->nik) }}" method="POST"> 
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="txtnik" class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control-plaintext" id="txtnik" name="txtnik" value="{{ $employee->nik }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtusername" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('txtusername') is-invalid @enderror" id="txtusername" name="txtusername" value="{{  $employee->username }}">
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
                    <input type="email" class="form-control @error('txtemail') is-invalid @enderror" id="txtemail" name="txtemail" value="{{  $employee->email }}">
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
                    <input type="phone" class="form-control @error('txtphone') is-invalid @enderror" id="txtphone" name="txtphone" value="{{  $employee->phone }}">
                    @error('txtphone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtstatus" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select @error('txtstatus') is-invalid @enderror" id="txtstatus" name="txtstatus">
                        <option value="1" {{ $employee->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $employee->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('txtstatus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-md btn-success" type="submit">UPDATE</button>
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