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

            <div class="mb-3">
                <label for="dt_created_date" class="form-label">Created Date:</label>
                <input type="date" name="dt_created_date" class="form-control" value="{{ $iso->dt_created_date }}" required>
            </div>

            <div class="mb-3">
                <label for="vc_created_user" class="form-label">Created User:</label>
                <select name="vc_created_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->code_emp }}" {{ $iso->vc_created_user == $user->code_emp ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dt_modified_date" class="form-label">Modified Date:</label>
                <input type="date" name="dt_modified_date" class="form-control" value="{{ $iso->dt_modified_date }}" required>
            </div>

            <div class="mb-3">
                <label for="vc_modified_user" class="form-label">Modified User:</label>
                <select name="vc_modified_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->code_emp }}" {{ $iso->vc_modified_user == $user->code_emp ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="comp_id" class="form-label">Company:</label>
                <select name="comp_id" class="form-select" required>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $iso->comp_id == $company->id ? 'selected' : '' }}>
                            {{ $company->short }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update ISO</button>
        </form>
    </div>
@endsection
