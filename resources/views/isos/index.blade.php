@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>ISO List</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($isos as $iso)
                    <tr>
                        <td>{{ $iso->id }}</td>
                        <td>{{ $iso->description }}</td>
                        <td>{{ $iso->dt_created_date }}</td>
                        <td>
                            <a href="{{ route('isos.edit', $iso->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('isos.destroy', $iso->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ Storage::disk('external')->url($iso->path . '/' . $iso->file_name) }}" target="_blank" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
