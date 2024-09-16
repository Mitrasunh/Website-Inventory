@extends('layouts.admin')

@section('main-content')
    @php
        $currentPageHeading = 'Add New User-Asset';
    @endphp

    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('userAsset/userAsset') }}')"> BACK</button>
        </div>
        <div class="card-body">
            <form action="{{ url('userAssets') }}" method="POST">
                @csrf

                <div class="mb-3 row">
                    <label for="txtidAsset" class="col-sm-2 col-form-label">Asset</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="txtidAsset" name="txtidAsset">
                            <option value="" disabled selected>-- Select Asset --</option>
                            @foreach ($assets as $asset)
                                @if (!$asset->userAsset || !$asset->userAsset->status)
                                    <option value="{{ $asset->idAsset }}" data-status="{{ $asset->status }}">
                                        {{ $asset->type }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="txtnik" class="col-sm-2 col-form-label">Employee</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="txtnik" name="txtnik">
                            <option value="" disabled selected>-- Select User --</option>
                            @foreach ($employees as $employee)
                                @if (!$employee->userAsset || !$employee->userAsset->status)
                                    <option value="{{ $employee->nik }}">
                                        {{ $employee->username }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtstartDate" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('txtstartDate') is-invalid @enderror" id="txtstartDate" name="txtstartDate" value="{{ old('txtstartDate') }}">
                        @error('txtstartDate')
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