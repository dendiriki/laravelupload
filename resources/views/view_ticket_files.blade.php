@extends('layouts.app')

@section('title', 'Files in Ticket')

@section('content')
    <div class="container">
        <h2>Files in Ticket {{ $ticket->document_name }}</h2>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">File</h3>
            </div>
            <div class="card-body">
                @if (!empty($file))
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $file }}</span>
                            <div class="btn-group" role="group" aria-label="File Actions">
                                {{-- <a href="{{ Storage::url($ticket->document_file) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ Storage::url($ticket->document_file) }}" class="btn btn-success btn-sm" download>Download</a> --}}

                                <a href="{{ asset('storage/' . $ticket->document_file) }}" class="btn btn-primary btn-sm">View</a>

                                <a href="{{ asset('storage/' . $ticket->document_file) }}" class="btn btn-success btn-sm" download>Download</a>
                            </div>
                        </li>
                    </ul>
                @else
                    <p>No files found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
