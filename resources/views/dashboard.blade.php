@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <h2>Welcome to the Dashboard {{ Auth::user()->username }}</h2>
    <p>This is your dashboard content.</p>


    @can('admin')
<div class="mt-4">

    <div class="pie-chart-container">
        <div class="pie-chart" style="--approved-percentage: {{ $approvedPercentage }}%; --not-approved-percentage: {{ $notApprovedPercentage }}%;">
            <div class="chart" onclick="location.href='{{ route('not.approved.url') }}'" style="background: conic-gradient(#f44336 0%, #f44336 var(--not-approved-percentage), #4CAF50 var(--not-approved-percentage), #4CAF50 100%);"></div>
            <div class="chart-text">{{ $notApprovedCount + $approvedCount }} Total<br>{{ $notApprovedCount }} Not Approved<br>{{ $approvedCount }} Approved</div>
        </div>
    </div>
    <div class="chart-actions">
        <button onclick="window.location='{{ route('not.approved.url') }}';">Not Approved</button>
        <button onclick="window.location='{{ route('approved.url') }}';">Approved</button>
        <button onclick="window.location='{{ route('released.url') }}';">Released</button>
    </div>
</div>

<style>
.pie-chart-container {
    position: relative;
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.chart {
    margin-top: 100px;
    width: 420px;
    height: 420px;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    z-index: 1;
}

.chart-text {
    margin-top: 50px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 2;
    color: #fff;
}

.chart-actions {
    text-align: center;
    margin-top: 20px;
}

.chart-actions button {
    padding: 10px 20px;
    margin: 0 10px;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
}

.chart-actions button:first-child {
    background-color: #f44336; /* Warna untuk Not Approved */
}

.chart-actions button:nth-child(2) {
    background-color: #4CAF50; /* Warna untuk Approved */
}

.chart-actions button:last-child {
    background-color: #2196F3; /* Warna untuk Release */
}

</style>

@endcan
@endsection
