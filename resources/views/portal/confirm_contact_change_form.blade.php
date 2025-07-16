<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <title>Change Number | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('app.name') }}" name="description" />
    <meta content="{{ config('app.name') }}" name="author" />
    <link rel="icon" href="{{ asset('logo-icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="auth-side-form">
            <h2>Confirm Phone Number Change</h2>
    <p>Hello {{ $applicant->surname ?? 'Applicant' }},</p>
    <p>Please re-type your new phone number to confirm the change from your old phone number.</p>

   <form action="{{ route('confirm.contact.change') }}" method="POST">
    @csrf
    {{-- <input type="hidden" name="applicant_id" value="{{ $applicant_id }}">
    <input type="hidden" name="new_contact" value="{{ $new_contact }}"> --}}
    <input type="hidden" name="token" value="{{ $token }}">

    <p>
        New Phone Number: <strong>{{ $new_contact }}</strong>
    </p>

    <p>
        <label for="confirm_new_contact">Please re-type the new phone number to confirm:</label><br>
        <input type="text" name="confirm_new_contact" id="confirm_new_contact" required pattern="\d{10}" maxlength="10">
    </p>

    <p>
        <label for="otp">Enter the OTP sent to your email:</label><br>
        <input type="text" name="otp" id="otp" required pattern="\d{6}" maxlength="6">
    </p>

    <button type="submit">Confirm Change</button>
</form>

        </div>
    </div>
</div>
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
</body>

</html>
