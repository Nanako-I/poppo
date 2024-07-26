<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\URL;

class CustomPasswordResetNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        $role_id = $notifiable->roles()->pluck('id')->first();

        if (in_array($role_id, [1, 2, 3, 4])) {
            $url = URL::to('/reset-password-staff/'.$this->token);
        } elseif (in_array($role_id, [5, 6])) {
            $url = URL::to('/reset-password/'.$this->token);
        } else {
            // デフォルトのURLにフォールバック
            $url = URL::to('/reset-password/'.$this->token);
        }

        return $this->buildMailMessage($url);
    }
}