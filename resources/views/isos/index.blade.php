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
                    <p class="mb-1">Created At: {{ $iso->created_at }}</p>
                    <p class="mb-1">Updated At: {{ $iso->updated_at }}</p>
                    <hr>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
