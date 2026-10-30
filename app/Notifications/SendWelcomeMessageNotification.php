<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class SendWelcomeMessageNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct() {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification())
            ]
        );
        return (new MailMessage)
            ->subject('Welcome to Our Clinic')
            ->greeting("Welcome, {$notifiable->name}!")
            ->line('Your account has been successfully created.')
            ->line('We are happy to have you with us.')
            ->line('Please verify your email address to activate your account.')
            ->action('Verify My Email', $verificationUrl)
            ->line('Thank you for joining us.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
