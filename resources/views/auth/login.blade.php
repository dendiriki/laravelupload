<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app') <!-- Sesuaikan dengan nama layout yang Anda gunakan -->

@section('content')
    <div class="container mt-5">
        <h2>Login</h2>

        @if ($errors->has('login'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('login') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection
