<!-- resources/views/file-list/view-files.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">View Files - {{ $folder }}</h2>

        @if ($files)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $index => $file)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ basename($file) }}</td>
                            <td>
                                @if (Storage::exists($file))
                                    <a href="{{ route('file.view', ['folder' => $folder, 'file' => basename($file)]) }}"
                                        class="btn btn-primary">View File</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No files found.</p>
        @endif

        <!-- Tombol kembali ke halaman utama -->
        <a href="{{ route('file.list') }}" class="btn btn-primary">Back to Upload</a>
    </div>
@endsection
