<?php

namespace App\Listeners;

use App\Events\CustomerToLegalInvitationEvent;
use App\Models\Counterparty;
use App\Models\User;
use App\Models\UserNotification;

class CustomerToLegalInvitationListener
{

    protected ?User $user;
    protected ?User $recipient;
    protected ?Counterparty $counterparty;

    /**
     * Handle the event.
     *
     * @param CustomerToLegalInvitationEvent $event
     * @return void
     */
    public function handle(CustomerToLegalInvitationEvent $event)
    {
        $payload = $event->notification->payload;

        $this->user = auth()->user();
        $this->recipient = User::find((int)($payload['sender_id'] ?? 0));
        $this->counterparty = Counterparty::find((int)($payload['counterparty_id'] ?? 0));

        if ($this->user && $this->recipient && $this->counterparty) {
            if ($event->invitationApproved) {
                $this->invitationApproved();
            } else {
                $this->invitationRejected();
            }
        }
    }

    protected function invitationApproved()
    {
        if ($this->user->isCustomerSimple) {
            $this->user->counterparties()->sync($this->counterparty->id);
            $this->user->manager_id = $this->recipient->manager_id;
            $this->user->setCustomerTypeLegal();
            $this->user->save();
        }

        $this->sendAnswer(
            sprintf(__('custom::site.info_messages.customer_approved_invitation'),
                $this->user->name,
                $this->counterparty->name,
            )
        );
    }

    protected function invitationRejected()
    {
        $this->sendAnswer(
            sprintf(__('custom::site.info_messages.customer_rejected_invitation'),
                $this->user->name,
                $this->counterparty->name,
            )
        );
    }

    protected function sendAnswer(string $message)
    {
        try {
            UserNotification::query()->updateOrCreate(
                [
                    'user_id' => $this->recipient->id,
                    'type' => 'customerToLegalInvitationAnswer',
                ],

                [
                    'user_id' => $this->recipient->id,
                    'type' => 'customerToLegalInvitation',
                    'level' => 'none',
                    'event' => '',
                    'message' => $message,
                    'payload' => [
                        'sender_id' => $this->user->id,
                        'buttons' => [
                            'yes' => __('custom::site.yes'),
                        ]
                    ]
                ]
            );
        } catch (\Exception $e) {
        }
    }
}
