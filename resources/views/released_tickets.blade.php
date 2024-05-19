@extends('layouts.app')

@section('title', 'Released Tickets')

@section('content')
    <div class="mt-4">
        <h2>Released Tickets</h2>
        @if ($releasedTickets->isEmpty())
            <p>No released tickets found.</p>
        @else
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Document Name</th>
                        <th>Department</th>
                        <th>Document Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($releasedTickets as $index => $ticket)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ticket->user->username }}</td>
                            <td>{{ $ticket->document_name }}</td>
                            <td>{{ $ticket->department->short }}</td>
                            <td>{{ $ticket->document_note }}</td>
                            <td>
                                <!-- Add action button for released tickets -->
                                <button onclick="window.location='{{ route('view.ticket.files', ['ticketNumber' => $ticket->number_ticket]) }}';">View</button>
                                <button onclick="window.location.href = '{{ route('ticket.detail', ['number_ticket' => $ticket->number_ticket]) }}'">Detail</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
