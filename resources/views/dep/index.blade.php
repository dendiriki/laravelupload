@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Departments</h2>
        <a href="{{ route('dep.create') }}" class="btn btn-primary">Add Department</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Short</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deps as $dep)
                    <tr>
                        <td>{{ $dep->id }}</td>
                        <td>{{ $dep->name }}</td>
                        <td>{{ $dep->short }}</td>
                        <td>
                            <!-- Tambahkan tombol untuk mengedit dan menghapus data -->
                            <a href="{{ route('dep.edit', $dep->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('dep.destroy', $dep->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
