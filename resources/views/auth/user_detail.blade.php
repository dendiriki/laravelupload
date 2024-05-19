@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User Detail</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h6><strong>Code Employee:</strong></h6>
                </div>
                <div class="col-md-9">
                    <p>{{ $user->code_emp }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h6><strong>Username:</strong></h6>
                </div>
                <div class="col-md-9">
                    <p>{{ $user->username }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h6><strong>Status:</strong></h6>
                </div>
                <div class="col-md-9">
                    <p>{{ $user->status }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h6><strong>Role:</strong></h6>
                </div>
                <div class="col-md-9">
                    <p>{{ $user->role }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h6><strong>Department:</strong></h6>
                </div>
                <div class="col-md-9">
                    <p>{{ $user->department->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h6><strong>Company:</strong></h6>
                </div>
                <div class="col-md-9">
                    <p>{{ $user->comp->name }}</p>
                </div>
            </div>
            <!-- tambahkan lebih banyak informasi pengguna sesuai kebutuhan -->
        </div>
    </div>
</div>
@endsection
