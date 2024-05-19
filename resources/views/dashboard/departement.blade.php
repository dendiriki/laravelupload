@extends('layouts.app')

@section('title', 'Departments Overview')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Departments Overview</h2>

    <div class="row">
        <!-- Departments With Tickets -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white bg-primary">
                    <h3 class="mb-0">Departments With Contribution</h3>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($departmentsWithTickets as $department)
                        <li class="list-group-item">{{ $department->name }} - Tickets: {{ $department->tickets->count() }}</li>
                    @empty
                        <li class="list-group-item">No departments with tickets.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Departments Without Tickets -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white bg-danger">
                    <h3 class="mb-0">Departments Without Contribution</h3>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($departmentsWithoutTickets as $department)
                        <li class="list-group-item">{{ $department->name }}</li>
                    @empty
                        <li class="list-group-item">All departments have tickets.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .card-header {
        font-size: 1.25rem;
    }
</style>
