@extends('layouts.app')

@section('content')
<style>
    .card {
        border: 1px solid #e3e6f0;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .card-header {
        background-color: #4e73df;
        color: white;
        font-weight: bold;
    }
    .form-label {
        font-weight: bold;
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }
    .btn-link {
        color: #4e73df;
        transition: color 0.3s;
    }
    .btn-link:hover {
        color: #2e59d9;
        text-decoration: underline;
    }
    .form-check-label {
        font-weight: normal;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card mt-5">
                <div class="card-header text-center">Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                            <a class="btn btn-link" href="{{ route('register') }}">
                                Register
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
