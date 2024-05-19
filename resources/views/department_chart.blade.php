@extends('layouts.app')

@section('title', 'Department Chart')

@section('content')
<div class="container">
    <h2>History Document</h2>
    <br>

    <!-- Styled Total Tickets Card -->
    <div class="row mb-4">
        <!-- Total Tickets Card -->
        <div class="col">
            <a href="{{route('tickets.dashboard')}}" class="text-decoration-none">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Tickets</div>
                    <div class="card-body">
                        <h5 class="card-title">Tickets Overview</h5>
                        <p class="card-text" style="font-size: 2em; font-weight: bold;">{{ $totalTickets }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Departments Card -->
        <div class="col">
            <a href="{{route('departments.overview')}}" class="text-decoration-none">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Total Departments</div>
                    <div class="card-body">
                        <h5 class="card-title">Departments Overview</h5>
                        <p class="card-text" style="font-size: 2em; font-weight: bold;">{{ $totalDepartments }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

    <div id="chartContainer">
        @foreach($ticketsDataByDepartment as $department => $count)
            <div class="bar-container">
                <div class="bar" style="width: {{ ($count / max($ticketsDataByDepartment)) * 100 }}%;">
                    <span class="bar-label">{{ $department }}</span>
                    <span class="bar-value">{{ $count }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    #chartContainer {
        width: 100%;
        padding: 20px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .bar-container {
        margin: 10px 0;
    }
    .bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #2243fc;
        color: white;
        padding: 10px;
        margin: 5px 0;
    }
    .bar-label {
        margin-right: 10px;
    }
    .bar-value {
        margin-left: 10px;
        font-weight: bold;
    }
</style>
@endsection
