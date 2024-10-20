<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otpCode;  // Make OTP available to the view

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otpCode)
    {
        $this->otpCode = $otpCode; // Pass OTP to constructor
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.otp')
                    ->subject('Your OTP Code')
                    ->with([
                        'otpCode' => $this->otpCode,
                    ]);
    }
}
