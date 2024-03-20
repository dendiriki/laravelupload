@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Department</h2>
        <form method="POST" action="{{ route('dep.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="short" class="form-label">Short</label>
                <input type="text" class="form-control" id="short" name="short" required>
            </div>
            <div class="mb-3">
                <label for="com_id" class="form-label">Company</label>
                <select class="form-control" id="com_id" name="com_id" required>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
