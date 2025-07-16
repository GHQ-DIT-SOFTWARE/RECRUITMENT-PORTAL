<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <title>OTP | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('app.name') }}" name="description" />
    <meta content="{{ config('app.name') }}" name="author" />
   <link rel="icon" href="{{ asset('new-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="auth-side-form">
            <form method="post" action="{{ route('otp-for-reprint') }}">
    @csrf
    <div style="text-align: center;">
        <img src="{{ asset('new-logo.png') }}" alt=""
            style=" width: 150px; height: 180px; object-fit: cover;">
    </div>
    <div class="auth-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h4 class="mb-4 f-w-100">Enter the one-time password sent to your phone number</h4>
        <div class="form-group mb-4">
            <label class="floating-label" for="otp">OTP Verification</label><br><br>
            <div class="otp-input-group" style="display: flex; gap: 8px; justify-content: center;">
                @for ($i = 1; $i <= 6; $i++)
                    <input type="text" name="otp[]" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                        class="otp-box form-control @error('otp') is-invalid @enderror"
                        style="width: 40px; height: 48px; text-align: center; font-size: 1.5rem; border: 1.5px solid #ccc; border-radius: 6px; box-shadow: none; display: inline-block;" 
                        required autocomplete="off" id="otp-{{ $i }}">
                @endfor
            </div>
            @error('otp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-block btn-primary mb-4">Verify OTP</button>
    </div>
</form>

<script>
// Auto-focus next box on input
document.querySelectorAll('.otp-box').forEach((box, idx, arr) => {
    box.addEventListener('input', function(e) {
        if (this.value.length === 1 && idx < arr.length - 1) {
            arr[idx + 1].focus();
        }
    });
    box.addEventListener('keydown', function(e) {
        if (e.key === "Backspace" && !this.value && idx > 0) {
            arr[idx - 1].focus();
        }
    });
});
// On submit, join values into a single hidden input
document.querySelector('form').addEventListener('submit', function(e) {
    let otp = Array.from(document.querySelectorAll('.otp-box')).map(i => i.value).join('');
    let hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'otp';
    hidden.value = otp;
    this.appendChild(hidden);
});
</script>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
</body>

</html>
