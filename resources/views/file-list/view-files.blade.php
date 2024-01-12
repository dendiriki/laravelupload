@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">View Files for ISO: '{{ $iso->description }}'</h2>

        <div class="row">
            <div class="col-md-6" style="margin-left: auto;">
                <form action="/view-files/{{$iso->id}}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Documents..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($documents->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Document Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $index => $document)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $document->description }}</td>
                            <td>{{$document->type->short}}</td>
                            <td>
                                <a href="{{ route('view.folder.contents', ['folder' => $document->id]) }}" class="btn btn-primary">View Folder Contents</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $documents->links() }}
        @else
            <p>No documents found for this ISO.</p>
        @endif



    </div>
@endsection
