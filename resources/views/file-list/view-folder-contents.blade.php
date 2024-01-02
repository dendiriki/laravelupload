@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">View Document: {{$document->description}} </h2>

        <div class="card mb-3">
            <div class="card-header">
                Cover
            </div>
            <div class="card-body">
                {{-- Konten untuk Cover --}}
                @foreach ($coverFiles as $cover)
                    <p>Description: {{ $cover->description }}</p>
                    <p>Tanggal Perubahan: {{ $cover->tgl_perubahan }}</p>
                    <p>Nama Document: {{$cover->document->description}}</p>
                    <p>Nama Create: {{$cover->createdBy->username}}</p>
                    <p>Tanggal Berlaku: {{$cover->tgl_berlaku}}</p>
                    <p>Type : {{$cover->document->type->short}}</p>
                    <a href="{{ route('view.pdf', ['id' => $cover->id]) }}" class="btn btn-primary" target="_blank">View File PDF Cover</a>

                    {{-- Tambahkan lebih banyak detail sesuai kebutuhan --}}
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
                    <p>Tanggal Perubahan: {{ $document->tgl_perubahan }}</p>
                    <p>Nama Document: {{$document->document->description}}</p>
                    <p>Nama Create: {{$document->createdBy->username}}</p>
                    <p>Tanggal Berlaku: {{$document->tgl_berlaku}}</p>
                    <p>Type : {{$document->document->type->short}}</p>
                    <a href="{{ route('view.pdfdoc', ['id' => $document->id]) }}" class="btn btn-primary" target="_blank">View File PDF Cover</a>
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
                    <p>Tanggal Perubahan: {{ $attachment->tgl_perubahan }}</p>
                    <p>Nama Document: {{$attachment->document->description}}</p>
                    <p>Nama Create: {{$attachment->createdBy->username}}</p>
                    <p>Tanggal Berlaku: {{$attachment->tgl_berlaku}}</p>
                    <p>Type : {{$attachment->document->type->short}}</p>
                    <a href="{{ route('view.pdflampiran', ['id' => $attachment->id]) }}" class="btn btn-primary" target="_blank">View File PDF Cover</a>
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
                <p>Tanggal Perubahan: {{ $record->tgl_perubahan }}</p>
                <p>Nama Document: {{$record->document->description}}</p>
                <p>Nama Create: {{$record->createdBy->username}}</p>
                <p>Tanggal Berlaku: {{$record->tgl_berlaku}}</p>
                <p>Type : {{$record->document->type->short}}</p>
                <a href="{{ route('view.pdfcatmut', ['id' => $record->id]) }}" class="btn btn-primary" target="_blank">View File PDF Cover</a>
                @endforeach
            </div>
        </div>

        <a href="{{ route('view.files', ['isoId' => $folder]) }}" class="btn btn-primary">Back to File List</a>
    </div>
@endsection
