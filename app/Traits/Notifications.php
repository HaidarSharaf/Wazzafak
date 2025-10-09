<?php

namespace App\Traits;

trait Notifications
{
    public function notify($variant, $title = null, $message = null, $sender = null)
    {
        $this->dispatch('notify',
            variant: $variant,
            title: $title,
            message: $message,
            sender: $sender
        );
    }
}
