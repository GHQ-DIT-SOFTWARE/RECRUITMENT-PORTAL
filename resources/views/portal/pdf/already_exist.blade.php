<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Already Exists</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 1rem;
        }
        .icon-large {
            font-size: 3.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-danger">
                    <div class="card-header bg-danger text-white text-center rounded-top">
                        <h3 class="mb-0">Application Error</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-exclamation-triangle-fill text-danger icon-large"></i>
                            <h4 class="mt-3 text-danger">Sorry, your information already exists in our system.</h4>
                            <p class="text-muted">
                                {{ session('message') ?? 'You cannot proceed with a new application using the same details.' }}
                            </p>
                        </div>
                        @if(session('reasons'))
                            <div class="alert alert-warning text-start">
                                <h5>Reasons:</h5>
                                <ul class="mb-0">
                                    @foreach (session('reasons') as $reason)
                                        <li>{{ $reason }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- <a href="{{ route('home') }}" class="btn btn-primary mt-3">Return to Homepage</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
