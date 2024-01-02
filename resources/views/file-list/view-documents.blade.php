@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Files in '{{ $folder }}'</h2>

        @if (!empty($files))
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">File Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $index => $file)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ basename($file) }}</td>
                            <td>
                                <a href="{{ Storage::disk('public')->url($file) }}" target="_blank"
                                    class="btn btn-primary">View File</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No files found in this folder.</p>
        @endif
    </div>
@endsection
