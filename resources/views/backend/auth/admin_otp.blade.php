@extends('backend.layouts.app')
@section('title', config('app.name', 'Wa Lone').' Admin Login OTP')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="col-md-4 col-sm-12">
                    <h1 class="text-center">{{ config('app.name') }}</h1>
                </div>
                <div class="col-md-8 col-sm-12 card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Admin Login OTP</h3>
                        <p class="text-success">We sent OTP code to <a href="https://accounts.google.com" target="_blank">{{ $session->email }}</a>. Please check your <a href="https://accounts.google.com" target="_blank">email</a>.</p>
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <input type="hidden" class="form-control text-light @error('email') is-invalid @enderror" name="email" value="{{ $session->email }}" required autocomplete="off">
                            <input type="hidden" class="form-control text-light @error('password') is-invalid @enderror" name="password" value="{{ $session->password }}" required autocomplete="off">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="form-group">
                                <label>OTP (One Time Password) *</label>
                                <input id="otp" type="number" class="form-control text-center text-light @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" autocomplete="off" placeholder="______" autofocus>
                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary mr-2 col">Confirm</button>
                                <a href="javascript:void[0]" class="btn btn-outline-primary resend-otp-btn col disabled">Resend OTP <span id="" class="countdown text-light"></span></a>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(() => {
        var timer2 = "05:00";
        var interval = setInterval(function() {

            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;

        }, 1000);

        $('.resend-otp-btn').click(function () {
           $.post("{{ route('admin.resend-otp') }}")
            .done(function (res) {
                if (res.result == 1) {
                    toastr.success(res.message);
                }
            })
            .fail(function (error) {
                toastr.error("Something wrong!");
            });
        });
    });
</script>
@endsection
