@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Set New Password</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.reset-password') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">New Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password:</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Set New Password</button>
        </form>
    </div>
@endsection
