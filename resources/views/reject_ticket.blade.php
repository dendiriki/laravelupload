@extends('layouts.app')

@section('title', 'Reject Ticket')

@section('content')
<div class="container">
    <h2>Reject Ticket: {{ $ticket->number_ticket }}</h2>
    <form action="{{ route('tickets.reject', $ticket->number_ticket) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="reason">Reason for Rejection</label>
            <textarea name="reason" id="reason" class="form-control" required></textarea>
        </div>
        <br>

        <!-- Input untuk empat file -->
        <button type="submit" class="btn btn-danger">Submit Rejection</button>
    </form>
</div>
@endsection
