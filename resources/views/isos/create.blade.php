@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Create ISO</h1>

        <form action="{{ route('isos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="dt_created_date" class="form-label">Created Date:</label>
                <input type="date" name="dt_created_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Upload File:</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create ISO</button>
        </form>
    </div>
@endsection
