<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class CustomVerifyEmail extends Notification
{
    protected $verificationCode;

    public function __construct()
    {
        Log::info('CustomVerifyEmail notification instantiated');
        $this->verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function via($notifiable): array
    {
        Log::info('Determining notification channels');
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        Log::info('Building email notification', [
            'user_id' => $notifiable->id,
            'email' => $notifiable->email,
            'code' => $this->verificationCode
        ]);

        // Store the code in verification_code column
        $notifiable->forceFill([
            'verification_code' => $this->verificationCode,
        ])->save();

        Log::info('Verification code stored', [
            'user_id' => $notifiable->id,
            'code' => $this->verificationCode,
            'stored_code' => $notifiable->verification_code
        ]);

        return (new MailMessage)
            ->subject('Verify Email Address')
            ->line('Your email verification code is: ' . $this->verificationCode)
            ->line('Please use this code to verify your email address.')
            ->line('This code will expire in 60 minutes.');
    }
} 