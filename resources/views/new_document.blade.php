@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New Document</h2>

    <!-- Tombol "Register New Document" -->
    <a href="{{ route('register.document') }}" class="btn btn-success float-right ml-2 mb-4">Register New Document</a>

    <!-- Tombol "Register Revision" -->
    <a href="{{ route('register.revision') }}" class="btn btn-primary float-right ml-2 mb-4">Register Revision</a>
    <br><br>

    <!-- Tabel untuk menampilkan tiket -->
    <h2>History Upload Document</h2>

    @if ($userTickets->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Number Ticket</th>
                    <th>Document Name</th>
                    <th>Document Note</th>
                    <th>Document Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userTickets as $ticket)
                    <tr>
                        <td>{{ $ticket->number_ticket }}</td>
                        <td>{{ $ticket->document_name }}</td>
                        <td>{{ $ticket->document_note }}</td>
                        <td>{{ $ticket->document_status }}</td>
                        <td style="display: flex; gap: 10px;">
                            <button class="btn btn-primary" onclick="window.location.href = '{{ route('view.ticket.files', ['ticketNumber' => $ticket->number_ticket]) }}'">View</button>
                            <button onclick="window.location.href = '{{ route('ticket.detail', ['number_ticket' => $ticket->number_ticket]) }}'" class="btn btn-info">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have no tickets.</p>
    @endif

</div>
@endsection
