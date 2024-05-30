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
                            <select class="form-select" name="dep">
                                <option value="">Select Departemen</option>
                                @foreach ($deps as $dep)
                                    <option value="{{ $dep->short }}" {{ request('dep') == $dep->short ? 'selected' : '' }}>
                                        {{ $dep->name }}
                                    </option>
                                @endforeach
                            </select>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($documents->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Document Name</th>
                    <th>Document No</th>
                    <th>ISO</th>
                    <th>Departement</th>
                    <th>Company</th>
                    <th>Action</th> <!-- Tambah kolom untuk Action -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td>{{ $document->id }}</td>
                            <td>{{ $document->description }}</td>
                            <td>{{ $document->doc_name }}</td>
                            <td>{{ $document->iso->description}}</td>
                            <td>{{ $document->dep_terkait }}</td>
                            <td>{{ $document->Company->name }}</td>
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
