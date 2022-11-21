@extends('backend.layouts.app')
@section('title', 'Admin Login OTP | ' . config('app.name', 'Wa Lone'))
@section('content')
<div class="auth-box row">
    </div>
    <div class="col-lg-5 col-md-7 bg-white card">
        <div class="p-3">
            <div class="text-center">
                <h3 class="text-primary">{{ config('app.name') }}</h3>
            </div>
            <hr>
            <h2 class="mt-3 text-center">Admin Login OTP</h2>
            <p class="text-center">We sent OTP code to <a href="https://accounts.google.com" target="_blank">{{ $session->email }}</a>. Please check your <a href="https://accounts.google.com" target="_blank">email</a>.</p>
            <hr>

            @include('backend.layouts.flash')

            <form class="mt-4" method="POST" action="{{ route('admin.two-step-otp') }}" id="adminOTPLoginForm">
                @csrf

                <input type="hidden" class="@error('email') is-invalid @enderror" name="email" value="{{ $session->email }}" required autocomplete="off">
                <input type="hidden" class="@error('password') is-invalid @enderror" name="password" value="{{ $session->password }}" required autocomplete="off">

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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="otp">OTP (One Time Password) *</label>
                            <input class="form-control text-center @error('otp') is-invalid @enderror" id="otp" type="number" name="otp" value="{{ old('otp') }}" autocomplete="off" placeholder="______" autofocus>
                            @error('otp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-block btn-primary my-1">Confirm</button>
                            </div>
                            <div class="col-md-6">
                                <a href="" id="resendOtpBtn" class="btn btn-block btn-outline-primary my-1 disabled">Resend OTP <span class="timer"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\Admin\AdminOTPLoginRequest', '#adminOTPLoginForm') !!}

<script>
    var resendOtpBtn = $('#resendOtpBtn');

    $(() => {
        var remain_second = "{{ $remain_seconds }}";
        var min = 00;
        var sec = 00;
        var countDown = setInterval(timer, 1000);

        function timer() {
            if (remain_second > 0) {

                remain_second--;

                min = Math.floor(remain_second / 60);
                sec = remain_second - (min * 60);

                if (min < 10) {
                    min = '0' + min.toString();
                }

                if (sec < 10) {
                    sec = '0' + sec.toString();
                }

                $('.timer').text(`(${min} : ${sec})`);

            } else {
                console.log('time out');
                clearInterval(countDown);

                resendOtpBtn.removeClass('disabled');
                resendOtpBtn.toggleClass('btn-outline-primary btn-primary');

                $('.timer').hide();
            }
        }

        $(document).on('click', '#resendOtpBtn', function (e) {
                e.preventDefault();

                $.post('{{ route("admin.resend-otp") }}').done((res) => {
                    if (res.result == 1) {
                        resendOtpBtn.addClass('disabled');
                        resendOtpBtn.toggleClass('btn-primary btn-outline-primary');

                        // toastr.success(res.message, 'Success', {timeOut: 3000});
                        window.location.reload();
                    } else {
                        toastr.error(res.message, 'Error', {timeOut: 5000});
                    }
                });
        });

        @if (session()->get('resend-otp'))
        toastr.success("{{ session()->get('resend-otp') }}", 'Success', {timeOut: 5000});
        @endif
    });
</script>
@endsection
