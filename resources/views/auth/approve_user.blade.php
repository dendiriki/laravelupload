@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Approve User</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('admin.reset-password.form') }}" class="btn btn-warning">Reset User Passwords</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        @if ($user->status === 'pending')
                                            <form action="{{ route('approveUser', $user->code_emp) }}" method="post" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('rejectUser', $user->code_emp) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('userDetail', $user->code_emp) }}" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
