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
    <link rel="icon" href="{{ asset('new-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<div class="auth-wrapper align-items-stretch aut-bg-img">
             <div class="flex-grow-1">

        <div class="auth-side-form">

            <form method="post" action="{{ route('portal.apply') }}">
                @csrf
                 <div style="text-align: center;">
                        <img src="{{ asset('new-logo.png') }}" alt=""
                             style=" width: 150px; height: 180px; object-fit: cover;">

                                        @if ($errors->any())
    <div class="alert alert-danger p-2 text-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li class="mb-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@endif


                    </div>
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
                        <label class="floating-label" for="email">Email</label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" name="email"
                            id="email" placeholder="">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <select class="form-control" id="arm_of_service" name="cause_offers" required>
                            <option value="">SELECT COURSE</option>
                            @foreach ($courses as $list)
                                <option value="{{$list->cause_offers }}">{{$list->cause_offers }}</option>
                            @endforeach
                        </select>

                        @error('cause_offers')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                 <div class="form-group mb-4">
                        <select class="form-control" id="entrance_type" name="entrance_type" required>
                            <option value="">TYPE OF APPLICATION</option>
                             <option value="REGULAR">REGULAR</option>
                              <option value="TOP UP">TOP UP</option>
                        </select>

                        @error('entrance_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-block btn-primary mb-4">Submit</button>
                    <p class="mb-2 text-muted">Forgot to Print Summary Sheet? <a
                            href="{{ route('print-summary-sheet') }}" class="f-w-400">Print</a></p>
                              <p class="mb-2 text-muted">Change Phone Number? <a
                            href="{{ route('confirm.contact.change') }}" class="f-w-400">Change Number</a></p>
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
