@component('mail::message')
    # Hello,

    You requested an OTP to reset your password.

    ## Your OTP Code is: **{{ $otpCode }}**

    This OTP is valid for the next 10 minutes.

    If you did not request this, please ignore this email.

    Thanks,
    {{ config('app.name') }}

    @component('mail::button', ['url' => config('app.url')])
        Go to Website
    @endcomponent
@endcomponent
