@extends('layouts.app')

@section('title', 'Edit Description')

@section('content')
<div class="container">
    <h2>Add to Description for Ticket: {{ $ticket->number_ticket }}</h2>
    <form action="{{ route('tickets.updateDescription', $ticket->number_ticket) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Add Description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter additional description here">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update Description</button>
    </form>
</div>
@endsection
