@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Doc Depts</h2>

        <div class="row">
            <div class="col-md-6" style="margin-left: auto;">
                <form action="/docdept">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Documents..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

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
                        <td>{{ $docDept->dep ? $docDept->dep->name : 'No Department' }}</td>
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
