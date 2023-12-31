<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app') <!-- Sesuaikan dengan nama layout yang Anda gunakan -->

@section('content')
    <div class="container mt-5">
        <h2>Register</h2>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="code_emp" class="form-label">Employee Code:</label>
                <input type="text" name="code_emp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <input type="text" name="role" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dep_id" class="form-label">Department ID:</label>
                <input type="text" name="dep_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="comp_id" class="form-label">Company ID:</label>
                <input type="text" name="comp_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
