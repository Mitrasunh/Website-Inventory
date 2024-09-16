@extends('layouts.admin')
@php
    $currentPageHeading = "History User - Assets";
@endphp
@section('main-content')
<div class="row">
    @foreach ($assetHistory as $assetData)
        <div class="col-lg-12"> 
            <div class="card mb-4">
                <div class="card-body">
                    <h5>{{ $assetData['type'] }} - {{ $assetData['name'] }}</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">User</th>
                                    <th class="text-nowrap">Start Date</th>
                                    <th class="text-nowrap">End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assetData['users'] as $key => $username)
                                    <tr>
                                        <td>{{ $username }}</td> 
                                        <td>{{ $assetData['user_start_dates'][$key] }}</td>
                                        <td>{{ $assetData['user_end_dates'][$key] ?: 'NULL' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
