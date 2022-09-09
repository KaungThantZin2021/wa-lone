@extends('frontend.layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

            {{-- @include('frontend.layouts.flash') --}}

            <div class="card">
                <div class="card-header text-primary">
                    Register
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Gender</label>
                            <br>
                            <div class="row @error('gender') is-invalid @enderror">
                                <div class="col-4 d-grid gap-1">
                                    <input type="radio" name="gender" class="btn-check" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} autocomplete="off">
                                    <label class="btn btn-sm btn-outline-secondary @error('gender') btn-outline-danger @enderror" for="male"><i class="fas fa-male"></i> Male</label>
                                </div>
                                <div class="col-4 d-grid gap-1">
                                    <input type="radio" name="gender" class="btn-check" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} autocomplete="off">
                                    <label class="btn btn-sm btn-outline-secondary @error('gender') btn-outline-danger @enderror" for="female"><i class="fas fa-female"></i> Female</label>
                                </div>
                                <div class="col-4 d-grid gap-1">
                                    <input type="radio" name="gender" class="btn-check" id="other" value="other" {{ old('gender') == 'other' ? 'checked' : '' }} autocomplete="off">
                                    <label class="btn btn-sm btn-outline-secondary @error('gender') btn-outline-danger @enderror" for="other"><i class="fas fa-genderless"></i> Other</label>
                                </div>
                            </div>
                            @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of birth</label>
                            <input type="date" name="dob" class="form-control" id="dob" placeholder="dd-mm-yyyy">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirmPassword">
                        </div>
                        <div class="row">
                            <div class="col-6 d-grid gap-1">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                            <div class="col-6 d-grid gap-1">
                                <a href="/" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
  </div>
@endsection
