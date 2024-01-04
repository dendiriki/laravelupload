<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app') <!-- Sesuaikan dengan nama layout yang Anda gunakan -->

@section('content')
    <div class="container mt-5">
        <h2>Register</h2>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="code_emp" class="form-label">Employee Code:</label>
                <input type="text" name="code_emp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label> <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="Admin" value="Admin">
                    <label class="form-check-label" for="Admin">Admin</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="View" value="View">
                    <label class="form-check-label" for="View">View</label>
                  </div>
            </div>
            <div class="mb-3">
                <label for="dep_id" class="form-label">Department ID:</label>
                <select name="dep_id" class="form-select" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="comp_id" class="form-label">Company ID:</label>
                <select name="comp_id" class="form-select" required>
                    @foreach ($companys as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
