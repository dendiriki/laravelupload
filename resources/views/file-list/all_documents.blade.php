@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">All Documents</h2>

        <div class="row">
            <div class="col-md-6" style="margin-left: auto;">
                <form action="{{ route('isos.allDocument') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Documents..." name="search" value="{{ request('search') }}">
                        <select class="form-select" name="dep">
                            <option value="">Select Department</option>
                            @foreach ($deps as $dep)
                                <option value="{{ $dep->short }}" {{ request('dep') == $dep->short ? 'selected' : '' }}>
                                    {{ $dep->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($documents->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Document Name</th>
                        <th scope="col">Document No</th>
                        <th scope="col">ISO</th>
                        <th scope="col">Department</th>
                        <th scope="col">Type</th>
                        <th scope="col">Revisi</th>
                        <th scope="col">View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $index => $document)
                        <tr>
                            <th>{{ $document->doc_id }}</th>
                            <td>{{ $document->description }}</td>
                            <td>{{ $document->document->doc_name }}</td>
                            <td>{{ $document->document->iso->description }}</td> {{-- Assuming 'iso' is a column in the DtHistDoc model --}}
                            <td>{{ $document->document->dep_terkait }}</td> {{-- Assuming 'department' is a column in the DtHistDoc model --}}
                            <td>{{ $document->document->type->short }}</td>
                            <th>{{ $document->revisi }}</th>
                            <td><a href="{{ route('view.pdfdoc', ['id' => $document->id]) }}" target="_blank" class="btn btn-info">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No documents found.</p>
        @endif
    </div>
@endsection
