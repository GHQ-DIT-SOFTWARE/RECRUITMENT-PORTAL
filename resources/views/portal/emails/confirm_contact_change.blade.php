<p>Hello {{ $applicant->surname }},</p>

<p>We received a request to change your phone number from <strong>{{ $oldContact }}</strong> to <strong>{{ $newContact }}</strong>.</p>

<p>Your OTP for confirming this change is: <strong>{{ $otp }}</strong></p>

<p>Please enter this OTP along with your new phone number to confirm the change by clicking the link below:</p>

<p><a href="{{ $url }}">Confirm Phone Number Change</a></p>

<p>If you didn’t request this change, you can safely ignore this email.</p>
