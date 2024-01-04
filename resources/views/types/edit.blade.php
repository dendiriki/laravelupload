@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Edit Type</h2>

        <!-- Menampilkan Pesan Kesalahan atau Sukses -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('types.update', $type->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="description" class="form-label">Type Name:</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ $type->description }}">
            </div>
            <div class="mb-3">
                <label for="short" class="form-label">Short Name:</label>
                <input type="text" name="short" class="form-control" id="short" value="{{ $type->short }}">
            </div>
            <div class="mb-3">
                <label for="dt_modified_date" class="form-label">Date</label>
                <input type="date" name="dt_modified_date" class="form-control" id="dt_modified_date" value="{{ $type->dt_modified_date }}">
            </div>
            <div class="mb-3">
                <label for="vc_created_user" class="form-label">User Create</label>
                <select id="vc_created_user" name="vc_created_user" class="form-select">
                    @foreach ($users as $user)
                        <option value="{{ $user->code_emp }}" {{ $user->code_emp == $type->vc_created_user ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="comp_id" class="form-label">Company</label>
                <select id="comp_id" name="comp_id" class="form-select">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $company->id == $type->comp_id ? 'selected' : '' }}>
                            {{ $company->short }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
@endsection
