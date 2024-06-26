<!-- resources/views/company/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Company List</h1>
        <a href="{{ route('company.create') }}" class="btn btn-success">Add Company</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Short</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan daftar perusahaan -->
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->short }}</td>
                        <td>
                            <a href="{{ route('company.edit', $company->id) }}" class="btn  btn-primary">Edit</a>

                            <form action="{{ route('company.destroy', $company->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Ensure this data has no relationships with other tables. Deleting related data will cause errors. Are you sure you want to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
