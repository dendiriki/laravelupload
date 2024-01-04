@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>ISOs</h1>

        <a href="{{ route('isos.create') }}" class="btn btn-primary">Create New ISO</a>

        <ul class="list-group mt-3">
            @foreach ($isos as $iso)
                <li class="list-group-item">
                    <h5 class="mb-1">Description: {{ $iso->description }}</h5>
                    <p class="mb-1">Created By: {{ $iso->createdBy->username }}</p>
                    <p class="mb-1">Modified By: {{ $iso->modifiedBy->username }}</p>
                    <p class="mb-1">Company: {{ $iso->company->short }}</p>
                    <p class="mb-1">Path: {{ $iso->path }}</p>
                    <p class="mb-1">Created At: {{ $iso->dt_created_date}}</p>
                    <p class="mb-1">Updated At: {{ $iso->dt_modified_date}}</p>

                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('isos.edit', $iso->id) }}" class="btn btn-warning mr-2">Edit</a>
                        <form action="{{ route('isos.destroy', $iso->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>

                    <hr>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
