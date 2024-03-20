@extends('layouts.app')

@section('title', 'Not Approved Tickets')

@section('content')
    <div class="mt-4">
        <h2>Not Approved Tickets</h2>
        @if ($notApprovedTickets->isEmpty())
            <p>No tickets found.</p>
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
                    @foreach ($notApprovedTickets as $index => $ticket)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ticket->user->username }}</td>
                            <td>{{ $ticket->document_name }}</td>
                            <td>{{ $ticket->department->short }}</td>
                            <td>{{ $ticket->document_note }}</td>
                            <td style="display: flex; gap: 10px;">
                                <button class="btn btn-primary" onclick="window.location.href = '{{ route('view.ticket.files', ['ticketNumber' => $ticket->number_ticket]) }}'">View</button>

                                <form action="{{ route('approve.document', ['number_ticket' => $ticket->number_ticket]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">approve</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
