@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Edit ISO</h1>

        <form action="{{ route('isos.update', $iso->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" name="description" class="form-control" value="{{ $iso->description }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update ISO</button>
        </form>
    </div>
@endsection
