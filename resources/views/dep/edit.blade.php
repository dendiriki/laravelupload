@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Department</h2>
        <form method="POST" action="{{ route('dep.update', $dep->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $dep->name }}" required>
            </div>
            <div class="mb-3">
                <label for="short" class="form-label">Short</label>
                <input type="text" class="form-control" id="short" name="short" value="{{ $dep->short }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
