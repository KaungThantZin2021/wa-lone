@extends('frontend.layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary">
                    Register
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Gender</label>
                            <br>
                            <input type="radio" name="gender" value="male" class="btn-check" name="options-outlined" id="male" autocomplete="off">
                            <label class="btn btn-sm btn-outline-primary" for="male"><i class="fas fa-male"></i> Male</label>

                            <input type="radio" name="gender" value="female" class="btn-check" name="options-outlined" id="female" autocomplete="off">
                            <label class="btn btn-sm btn-outline-primary" for="female"><i class="fas fa-female"></i> Female</label>

                            <input type="radio" name="gender" value="other" class="btn-check" name="options-outlined" id="other" autocomplete="off">
                            <label class="btn btn-sm btn-outline-primary" for="other"><i class="fas fa-genderless"></i> Other</label>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of birth</label>
                            <input type="date" name="dob" class="form-control" id="dob" placeholder="dd-mm-yyyy">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
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
