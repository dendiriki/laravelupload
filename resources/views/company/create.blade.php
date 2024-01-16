<!-- resources/views/company/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Create Company</h1>

        <form action="{{ route('company.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="short" class="form-label">Short:</label>
                <input type="text" name="short" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Company</button>
        </form>
    </div>
@endsection
