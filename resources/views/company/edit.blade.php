<!-- resources/views/company/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Edit Company</h1>

        <form action="{{ route('company.update', ['id' => $company->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
            </div>

            <div class="mb-3">
                <label for="short" class="form-label">Short:</label>
                <input type="text" name="short" class="form-control" value="{{ $company->short }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>
    </div>
@endsection
