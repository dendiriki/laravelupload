@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Reset Password</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Employee Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->code_emp }}</td>
                        <td>
                            <form action="{{ route('admin.reset-password') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="code_emp" value="{{ $user->code_emp }}">
                                <button type="submit" class="btn btn-danger">Reset Password</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
