@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2>Welcome to the Dashboard {{ Auth::user()->username }}</h2>
<p>This is your dashboard content.</p>

@can('admin')
<div class="mt-4">
    <!-- Position a button container in the top-right corner of the chart container -->
    <div class="d-flex justify-content-between">
        <h3></h3>
        <a href="{{ route('chart.page') }}" class="btn btn-info">DOCUMENT BY DEPARTMENT WISE</a>
    </div>
    <div class="pie-chart-container">
        <div class="pie-chart" style="--new-document-percentage: {{ $newDocumentPercentage }}%; --revision-document-percentage: {{ $revisionDocumentPercentage }}%;">
            <div class="chart" style="background: conic-gradient(
                #2243fc 0%,
                #2243fc var(--new-document-percentage),
                #e1a901 var(--new-document-percentage),
                #e1a901 100%
            );"></div>
            <div class="chart-text">{{ $newDocumentCount }} New Document<br>{{ $revisionDocumentCount }} Revision Document</div>
        </div>
    </div>
    <div class="chart-legend">
        <div class="legend-item">
            <span class="legend-color" style="background-color: #2243fc;"></span> New Document
        </div>
        <div class="legend-item">
            <span class="legend-color" style="background-color: #e1a901;"></span> Revision Document
        </div>
    </div>
    <div class="chart-actions">
        <div class="card">
            <span class="card-title">Total Tickets</span>
            <span class="card-value">{{ $totalCount }}</span>
        </div>
        <div class="card">
            <span class="card-title">Not Approved</span>
            <span class="card-value">{{ $notApprovedCount }}</span>
        </div>
        <div class="card">
            <span class="card-title">Approved</span>
            <span class="card-value">{{ $approvedCount }}</span>
        </div>
        <div class="card">
            <span class="card-title">Released</span>
            <span class="card-value">{{ $releasedCount }}</span>
        </div>
    </div>
    <div class="chart-actions">
        <button class="custom-button" onclick="window.location='{{ route('not.approved.url') }}';" style="background-color: #E53935;">Approval Process</button>
        <button class="custom-button" onclick="window.location='{{ route('approved.url') }}';" style="background-color: #43A047;">Release Process</button>
        <button class="custom-button" onclick="window.location='{{ route('released.url') }}';" style="background-color: #1E88E5;">Release List</button>
    </div>
</div>
<br><br><br>
@endcan

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

    .chart-legend {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-right: 15px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        display: inline-block;
        margin-right: 5px;
    }

    .chart-actions {
        text-align: center;
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 10px;
        padding: 20px;
        min-width: 150px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-value {
        font-size: 18px;
        color: #333;
    }

    .custom-button {
        padding: 10px 20px;
        margin: 5px;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        min-width: 160px;
        background-color: #1976D2;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        transition: background-color 0.3s, box-shadow 0.2s;
    }

    .custom-button:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        opacity: 0.9;
    }
</style>

@endsection
