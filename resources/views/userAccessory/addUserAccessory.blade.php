@extends('layouts.admin')

@section('main-content')
    @php
        $currentPageHeading = 'Add New Accessory ';
    @endphp
    {{-- // . $addUserAccessories->first()->username --}}
    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-primary" onclick="redirectOnClick('{{ url('userAccessory/userAccessory') }}')"> BACK</button>
        </div>
        <div class="card-body">
            <form action="{{ url('userAccessories') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="txtnik" class="col-sm-2 col-form-label">Employee</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="txtnik" name="txtnik">
                                <option value="" disabled selected>-- Select User --</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->nik }}">
                                        {{ $employee->username }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="txtmodelNumber" class="col-sm-2 col-form-label">Accessory</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="txtmodelNumber" name="txtmodelNumber[]" multiple>
                                <option value="" disabled selected>-- Select Accessory --</option>
                                @foreach($accessories_data as $accessory)
                                    <option value="{{ $accessory['modelNumber'] }}">
                                        {{ $accessory['category'] }} - {{ $accessory['modelNumber'] }}
                                    </option>
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