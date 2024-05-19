@extends('layouts.app')

@section('title', 'Tickets List')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">Tickets List</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Number Ticket</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Document Name</th>
                            <th scope="col">Document Status</th>
                            <th scope="col">Document Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->number_ticket }}</td>
                            <td>{{ $ticket->user->username ?? 'N/A' }}</td>
                            <td>{{ $ticket->document_name }}</td>
                            <td> {{ $ticket->document_status}} </td>
                            <td>{{ $ticket->document_note }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Tickets Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .badge-danger, .badge-success, .badge-secondary {
        color: #fff !important; /* Ensure text color is white for visibility */
    }
    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.75em;
    }
    .thead-light th {
        background-color: #e2e3e5;
        color: #495057;
    }
    .card {
        border: none;
    }
</style>
@endsection
