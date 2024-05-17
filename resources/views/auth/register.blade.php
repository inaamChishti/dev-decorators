@extends('layouts.app')

@section('content')
    <style>
        .card {
            border: 1px solid #e3e6f0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
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
                    <div class="card-header text-center textCustomColor">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Enter your name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Enter your email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror"
                                    name="gender" required>
                                    <option value="" disabled selected>Select your gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Enter your password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm your password">
                            </div>

                            <div class="mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
