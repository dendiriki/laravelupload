@extends('layouts.app')

@section('title', 'Files in Ticket')

@section('content')
    <div class="container">
        <h2>Files in Ticket {{ $ticket->document_name }}</h2>
        @foreach($folders as $folderName => $files)
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">{{ ucfirst($folderName) }}</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $file }}</span>
                                <div class="btn-group" role="group" aria-label="File Actions">
                                    <a href="{{ asset('storage/' . $ticket->document_file . '/' . $folderName . '/' . $file) }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ asset('storage/' . $ticket->document_file . '/' . $folderName . '/' . $file) }}" class="btn btn-success btn-sm" download>Download</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
