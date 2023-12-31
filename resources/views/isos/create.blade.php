@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Create ISO</h1>

        <form action="{{ route('isos.store') }}" method="POST">
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
                <label for="vc_created_user" class="form-label">Created User:</label>
                <select name="vc_created_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->code_emp }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dt_modified_date" class="form-label">Modified Date:</label>
                <input type="date" name="dt_modified_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="vc_modified_user" class="form-label">Modified User:</label>
                <select name="vc_modified_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->code_emp }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="comp_id" class="form-label">Company:</label>
                <select name="comp_id" class="form-select" required>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->short }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create ISO</button>
        </form>
    </div>
@endsection
