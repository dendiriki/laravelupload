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
            <div class="mb-3">
                <label for="com_id" class="form-label">Company</label>
                <select class="form-control" id="com_id" name="com_id" required>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $dep->com_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
