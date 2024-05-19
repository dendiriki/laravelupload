@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        @if ($errors->has('login'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('login') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('status'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        </form>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}"
                            class="btn btn-link">{{ __('Register here') }}</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
