<?php

namespace App\Events;

use App\Models\UserNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerToLegalInvitationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public UserNotification $notification;
    public bool $invitationApproved;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserNotification $notification, bool $approved = true)
    {
        $this->notification = $notification;
        $this->invitationApproved = $approved;
    }
}
