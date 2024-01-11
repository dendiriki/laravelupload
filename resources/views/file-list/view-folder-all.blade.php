@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">View Document: {{ $document->description }} </h2>

        <div class="card mb-3">
            <div class="card-header">
                Cover
            </div>
            <div class="card-body">
                {{-- Konten untuk Cover --}}
                @foreach ($coverFiles as $cover)
                    <p>Description: {{ $cover->description }}</p>
                    <p>Tanggal Perubahan: {{ $cover->created_at }}</p>
                    <p>Create By : {{ $cover->createdBy->username }}</p>
                    <p>Revisi : {{ $cover->revisi }}</p>
                    <p>Number Doc : {{ $cover->doc_name }}</p>
                    <a href="{{ route('view.pdf', ['id' => $cover->id]) }}" class="btn btn-primary" target="_blank">View File
                        PDF Cover</a>

                    <hr>
                @endforeach
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Document
            </div>
            <div class="card-body">
                {{-- Konten untuk Document --}}
                @foreach ($documentFiles as $document)
                    <p>Description: {{ $document->description }}</p>
                    <p>Tanggal Perubahan: {{ $document->created_at }}</p>
                    <p>Create By : {{ $document->createdBy->username }}</p>
                    <p>Revisi : {{ $document->revisi }}</p>
                    <p>Number Doc : {{ $cover->doc_name }}</p>
                    <a href="{{ route('view.pdfdoc', ['id' => $document->id]) }}" class="btn btn-primary"
                        target="_blank">View File PDF Cover</a>

                    <hr>
                @endforeach
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Attachment
            </div>
            <div class="card-body">
                {{-- Konten untuk Attachment --}}
                @foreach ($attachmentFiles as $attachment)
                    <p>Description: {{ $attachment->description }}</p>
                    <p>Tanggal Perubahan: {{ $attachment->created_at }}</p>
                    <p>Create By : {{ $attachment->createdBy->username }}</p>
                    <p>Revisi : {{ $attachment->revisi }}</p>
                    <p>Number Doc : {{ $cover->doc_name }}</p>
                    <a href="{{ route('view.pdflampiran', ['id' => $attachment->id]) }}" class="btn btn-primary"
                        target="_blank">View File PDF Cover</a>

                    <hr>
                @endforeach
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Record
            </div>
            <div class="card-body">
                {{-- Konten untuk Record --}}
                @foreach ($recordFiles as $record)
                    <p>Description: {{ $record->description }}</p>
                    <p>Tanggal Perubahan: {{ $record->created_at }}</p>
                    <p>Create By : {{ $record->createdBy->username }}</p>
                    <p>Revisi : {{ $record->revisi }}</p>
                    <p>Number Doc : {{ $cover->doc_name }}</p>
                    <a href="{{ route('view.pdfcatmut', ['id' => $record->id]) }}" class="btn btn-primary"
                        target="_blank">View File PDF Cover</a>

                    <hr>
                @endforeach
            </div>
        </div>

        <a href="{{ route('view.files', ['isoId' => $folder]) }}" class="btn btn-primary">Back to File List</a>
    </div>
@endsection
