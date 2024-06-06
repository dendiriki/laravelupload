@extends('layouts.app')

@section('title', 'Files in Ticket')

@section('content')
    <div class="container">
        <h2>Files in Ticket {{ $ticket->document_name }}</h2>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Files</h3>
            </div>
            <div class="card-body">
                @if (!empty($files))
                    <ul class="list-group">
                        @foreach ($files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $file }}</span>
                                <div class="btn-group" role="group" aria-label="File Actions">
                                    <a href="{{ asset('public/' . $ticket->document_file . '/' . $file) }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ asset('public/' . $ticket->document_file . '/' . $file) }}" class="btn btn-success btn-sm" download>Download</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No files found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
