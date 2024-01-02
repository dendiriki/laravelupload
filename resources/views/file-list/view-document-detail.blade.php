{{-- view-document-detail.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Document Detail: '{{ $document->name }}'</h2>

        {{-- Tampilkan detail dan revisi dokumen di sini --}}
        {{-- Contoh: --}}
        @foreach ($revisions as $revision)
            <p>{{ $revision->description }}</p>
            {{-- Tambahkan detail lainnya sesuai kebutuhan --}}
        @endforeach

        <a href="{{ route('view.documents.in.iso', ['isoId' => $document->iso_id]) }}" class="btn btn-primary">Back to
            Documents</a>
    </div>
@endsection
