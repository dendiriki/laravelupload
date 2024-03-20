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
                    <th>Company</th> <!-- Kolom baru untuk nama perusahaan -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deps as $dep)
                    <tr>
                        <td>{{ $loop->iteration + ($deps->currentPage() - 1) * $deps->perPage() }}</td>
                        <td>{{ $dep->name }}</td>
                        <td>{{ $dep->short }}</td>
                        <td>{{ $dep->company ? $dep->company->name : 'No Company' }}</td> <!-- Menampilkan nama perusahaan atau 'No Company' -->
                        <td>
                            <a href="{{ route('dep.edit', $dep->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('dep.destroy', $dep->id) }}" method="POST" style="display: inline" onsubmit="return confirmDelete()">
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
    {{ $deps->links() }}

    <script>
        function confirmDelete() {
            return confirm('Apakah anda yakin untuk menghapus departement ini ?. sebelum menghapus data ini tolong pastikan tidak ada tabel docdep yang berkaitan dengan depertemnet ini');
        }
    </script>
@endsection
