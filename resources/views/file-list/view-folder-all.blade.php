@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">View Document: {{ $document->description }} </h2>

        <div class="card mb-3">
            <div class="card-header">
                Document
            </div>
            <div class="card-body">
                {{-- Konten untuk Document --}}
                @foreach ($documentFiles as $document)
                    <p>Description: {{ $document->description }}</p>
                    <p>Tanggal Berlaku: {{ $document->tgl_berlaku }}</p>
                    <p>Create By : {{ $document->createdBy->username }}</p>
                    <p>Revisi : {{ $document->revisi }}</p>
                    <p>Number Doc : {{ $document->doc_name }}</p>
                    <a href="{{ route('view.pdfdoc', ['id' => $document->id]) }}" class="btn btn-primary"
                        target="_blank">View File PDF Cover</a>

                    <hr>
                @endforeach
            </div>
        </div>


        <a href="{{ route('view.files', ['isoId' => $folder]) }}" class="btn btn-primary">Back to File List</a>
    </div>
@endsection
