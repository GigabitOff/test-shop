<?php

namespace App\Http\Livewire\Forms;

use App\Models\User;
use App\Models\UserNotification;
use Livewire\Component;

class NotificationMessageLivewire extends Component
{
    public ?UserNotification $notification = null;
    public string $buttonYes = '';
    public string $buttonNo = '';

    public string $currentUrl;

    public function mount()
    {
        $this->currentUrl = url()->full();

        /** @var ?User $user */
        $user = auth()->user();

        if ($user && $user->notify
            && $this->notification = $user->myOldestNotification) {
            $buttons = $this->notification->payload['buttons'] ?? ['yes' => __('custom::site.yes')];
            $this->buttonYes = $buttons['yes'] ?? '';
            $this->buttonNo = $buttons['no'] ?? '';
        }
    }

    public function render()
    {
        return view('livewire.forms.notification-message-livewire');
    }

    public function onUserAction($approved)
    {
        if (!$this->notification) {
            return;
        }

        try {
            $event = app($this->notification->event);
            $event->dispatch($this->notification, (bool)$approved);
        } catch (\Exception $e) {
        }

        if ($approved) {
            if ($this->notification->payload['redirect_yes'] ?? false) {
                $this->redirect($this->currentUrl);
            }
        } else {
            if ($this->notification->payload['redirect_no'] ?? false) {
                $this->redirect($this->currentUrl);
            }
        }


        $this->notification->delete();
        $this->notification = null;
    }

    public function hasTwoButtons(): bool
    {
        return $this->buttonYes && $this->buttonNo;
    }
}
