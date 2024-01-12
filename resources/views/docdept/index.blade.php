@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Doc Depts</h2>
        <a href="{{ route('docdept.create') }}" class="btn btn-primary mb-3">Create Doc Dept</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Document</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docDepts as $docDept)
                    <tr>
                        <td>{{ $docDept->id }}</td>
                        <td>{{ $docDept->document->description }}</td>
                        <td>{{ $docDept->dep->name }}</td>
                        <td>
                            <form action="{{ route('docdept.destroy', $docDept->id) }}" method="POST">
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
    {{ $docDepts->links() }}
@endsection
