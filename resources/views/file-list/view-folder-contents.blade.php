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
                    {{-- <a href="{{asset('storage/' . $cover->link_document)}}" class="btn btn-primary">View File PDF Cover</a> --}}

                    <object width="100%" height="700px" type="application/pdf" data="{{asset('storage/' . $cover->link_document)}}#toolbar=0" id="pdf_content">
                        <p>Document load was not successful.</p>
                         </object>';
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
                    {{-- Tambahkan lebih banyak detail sesuai kebutuhan --}}
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
                    {{-- Tambahkan lebih banyak detail sesuai kebutuhan --}}
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
                    {{-- Tambahkan lebih banyak detail sesuai kebutuhan --}}
                @endforeach
            </div>
        </div>

        <a href="{{ route('view.files', ['isoId' => $folder]) }}" class="btn btn-primary">Back to File List</a>
    </div>
@endsection
