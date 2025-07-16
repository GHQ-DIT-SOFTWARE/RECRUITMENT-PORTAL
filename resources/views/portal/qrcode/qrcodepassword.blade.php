<!DOCTYPE html>
<html>
<head>
    <title>Enter Password</title>
</head>
<body>
    <h1>Enter Password to Access Data</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('qr-code.validate-password') }}" method="POST">
        @csrf
        <input type="hidden" name="applicant_serial_number" value="{{ $serialNumber }}">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
