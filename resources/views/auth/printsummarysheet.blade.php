<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <title>REPRINT-SUMMARY-SHEET | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('app.name') }}" name="description" />
    <meta content="{{ config('app.name') }}" name="author" />
    <link rel="icon" href="{{ asset('new-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">

        <div class="auth-side-form">

            <form method="post" action="{{ route('print-summary') }}">
                @csrf
                <div class=" auth-content">
                     <div style="text-align: center;">
                        <img src="{{ asset('new-logo.png') }}" alt=""
                             style=" width: 150px; height: 180px; object-fit: cover;">
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h6 class="mb-4 f-w-400 text-center">REPRINT-SUMMARY-SHEET</h6>
                    <div class="form-group mb-3">
                        <label class="floating-label" for="serial_number">Voucher Code</label>
                        <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                            id="serial" name="serial_number" placeholder="">
                        @error('serial_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="contact">Contact</label>
                        <input type="contact" class="form-control @error('contact') is-invalid @enderror" name="contact"
                            id="contact" placeholder="">
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-block btn-primary mb-4">Submit</button>

                </div>
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
