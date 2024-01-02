@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">View Files for ISO: '{{ $iso->description }}'</h2>

        @if ($documents->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Document Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $index => $document)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $document->description }}</td>
                            <td>
                                <a href="{{ route('view.folder.contents', ['folder' => $document->id]) }}" class="btn btn-primary">View Folder Contents</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No documents found for this ISO.</p>
        @endif



    </div>
@endsection
