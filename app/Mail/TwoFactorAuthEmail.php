<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class TwoFactorAuthEmail extends Mailable
{
    use SerializesModels;

    public $code;
    public $email;
    /**
     * Create a new message instance.
     *
     * @param string $code
     * @return void
     */
    public function __construct($code, $email)
    {
      //  dd($code);
        $this->code = $code;
         $this->email = $email;
       //  dump($this->code);
       //  dd($this->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Two-Factor Authentication Code')
                    ->view('emails.two_factor_auth') // This view will contain the email template
                    ->with([
                        'code' => $this->code,
                        'email' => $this->email, // Passing the 2FA code to the view
                    ]);
    }
}