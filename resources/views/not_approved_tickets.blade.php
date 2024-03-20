<!-- resources/views/not_approved_tickets.blade.php -->

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
                        <th>Departement</th>
                        <th>Document Note</th>
                        <th>Action</th> <!-- Kolom untuk tombol -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notApprovedTickets as $index => $ticket)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ticket->user->username }}</td> {{-- Misalnya user --}}
                            <td>{{ $ticket->document_name }}</td>
                            <td>{{ $ticket->department->short}}</td>
                            <td>{{ $ticket->document_note}}</td>
                            <!-- Tambahkan tombol di dalam kolom -->
                            <td style="display: flex; gap: 10px;">
                                <button class="btn btn-primary" onclick="window.location.href = '{{ route('view.ticket.files', ['ticketNumber' => $ticket->number_ticket]) }}'">View</button>
                                <button onclick="window.location.href = '{{ route('ticket.detail', ['number_ticket' => $ticket->number_ticket]) }}'" class="btn btn-info">Detail</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
