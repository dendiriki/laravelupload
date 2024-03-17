@extends('layouts.app')

@section('title', 'Ticket Detail')

@section('content')
    <div class="container">
        <h2>Ticket Detail</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Number Ticket:</strong> {{ $ticket->number_ticket }}
                </div>
                <div class="mb-3">
                    <strong>User:</strong> {{ $ticket->user->username }}
                </div>
                <div class="mb-3">
                    <strong>Document Name:</strong> {{ $ticket->document_name }}
                </div>
                <div class="mb-3">
                    <strong>Department:</strong> {{ $ticket->department->name }}
                </div>
                <div class="mb-3">
                    <strong>Description:</strong> {{ $ticket->description }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Company:</strong> {{ $ticket->company->name }}
                </div>
                <div class="mb-3">
                    <strong>Document File:</strong> {{ $ticket->document_file }}
                </div>
                <div class="mb-3">
                    <strong>Document Status:</strong> {{ $ticket->document_status }}
                </div>
                <div class="mb-3">
                    <strong>Document Note:</strong> {{ $ticket->document_note }}
                </div>
                <div class="mb-3">
                    <strong>Tanggal:</strong> {{ $ticket->tanggal }}
                </div>
            </div>
        </div>
    </div>
@endsection
