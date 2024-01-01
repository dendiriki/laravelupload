<!-- resources/views/dthistdoc/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data DtHistDoc</h2>
    <a href="{{ route('dthistdoc.create') }}" class="btn btn-primary">Tambah Data</a>
    <table class="table">
        <thead>
            <tr>
                <!-- Sesuaikan header tabel dengan kolom-kolom yang ada -->
            </tr>
        </thead>
        <tbody>
            @foreach($dtHistDocs as $dtHistDoc)
                <tr>
                    <!-- Tampilkan data sesuai dengan struktur model -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
