<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content=""/>
    <title>PORTAL | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('app.name') }}" name="description" />
    <meta content="{{ config('app.name') }}" name="author" />
    <link rel="icon" href="{{ asset('logo-icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
   <style>
    @media (max-width: 600px) {
        .bg-toggle-btn {
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 1051;
            background: rgba(255,255,255,0.85);
            border: none;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .bg-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 1050;
            background: rgba(0,0,0,0.2);
            display: none;
            animation: fadeIn 0.3s;
        }
        .bg-overlay.active {
            display: block;
        }
        .auth-side-form.bg-hidden {
            display: none !important;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    }
</style>
</head>

<body>
    <button type="button" class="bg-toggle-btn d-md-none" id="toggleBgBtn" title="Show Background">
        <span id="toggleBgIcon">?</span>
    </button>
    <div class="bg-overlay" id="bgOverlay"></div>


<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">

        <div class="h-100 d-md-flex align-items-center auth-side-img">
            <div class="col-sm-10 auth-content w-auto" style="background-color:#272c2aab;">
                <h1 class="text-white my-4">Welcome to the GAF Recruitment Portal</h1>
                <ul class="text-white">
                    <li>Kindly <b><a href="https://apply.mil.gh/"><u>read</u></a></b> the general eligibility before
                        applying.</li>
                    <li>Once <b>Submitted</b>, the information provided <b>cannot</b> be changed</li>
                    <li>If at any point during the application process, an applicant decides not to continue , simply
                        close the page to discontinue without submitting. Applications are only saved when the submit
                        button is clicked.
                    </li>
                    <li>Once a scratch card is used for application, it cannot be reused.</li>
                </ul>
            </div>
        </div>
        <div class="auth-side-form">

            <form method="post" action="{{ route('portal.apply') }}">
                @csrf
                 <div style="text-align: center;">
                    <img src="{{ asset('auth_logo_2.png') }}" alt="Logo"
                        class="login-logo-img"
                        style="width: 320px;  object-fit: cover;">
                    @if ($errors->any())
                        <div class="alert alert-danger p-2 text-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li class="mb-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <style>
                    @media (max-width: 600px) {
                        .login-logo-img {
                            width: 90px !important;
                            height: 90px !important;
                        }
                    }
                </style>

                <div class=" auth-content">
                     <div class="form-group mb-3">
                        <label class="floating-label" for="serial_number">Serial Number</label>
                        <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                            id="serial" name="serial_number" placeholder="">
                        @error('serial_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="floating-label" for="pincode">Pincode</label>
                        <input type="text" class="form-control @error('pincode') is-invalid @enderror"
                            id="serial" name="pincode" placeholder="">
                        @error('pincode')
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

                 <div class="form-group mb-4">
                        <select class="form-control" id="arm_of_service" name="arm_of_service" required>
                            <option value="">ARM OF SERVICE</option>
                             <option value="ARMY">ARMY</option>
                              <option value="NAVY">NAVY</option>
                              <option value="AIRFORCE">AIRFORCE</option>
                        </select>

                        @error('arm_of_service')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                 <div class="form-group mb-4">
                        <select class="form-control" id="trade_type" name="trade_type" required>
                            <option value="">SELECT TRADE TYPE</option>
                             <option value="TRADESMEN">TRADESMEN</option>
                              <option value="NON-TRADESMEN">NON-TRADESMEN</option>
                        </select>
                        @error('trade_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-block btn-primary mb-4">Submit</button>
                    <p class="mb-2 text-muted">Forgot to Print Summary Sheet? <a
                            href="{{ route('print-summary-sheet') }}" class="f-w-400">Print</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('toggleBgBtn');
        var overlay = document.getElementById('bgOverlay');
        var form = document.querySelector('.auth-side-form');
        var icon = document.getElementById('toggleBgIcon');

        btn.addEventListener('click', function() {
            form.classList.toggle('bg-hidden');
            overlay.classList.toggle('active');
            icon.innerHTML = form.classList.contains('bg-hidden') ? '&#10006;' : '&#128065;';
        });

        overlay.addEventListener('click', function() {
            form.classList.remove('bg-hidden');
            overlay.classList.remove('active');
            icon.innerHTML = '&#128065;';
        });
    });
</script>
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
</body>

</html>
