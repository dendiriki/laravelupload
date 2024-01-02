@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Files in '{{ $folder }}'</h2>

        @if (!empty($fileDetails))
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">File Name</th>
                        <th scope="col">Details</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fileDetails as $index => $file)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $file['name'] }}</td>
                            <td>{{ $file['details']->description ?? 'No additional details' }}</td>
                            <td><a href="{{ Storage::url($file['link']) }}" target="_blank" class="btn btn-primary">View
                                    File</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No files found in this folder.</p>
        @endif

        <a href="{{ route('view.files', ['isoId' => $isoId]) }}" class="btn btn-primary">Back to Documents</a>
    </div>
@endsection
