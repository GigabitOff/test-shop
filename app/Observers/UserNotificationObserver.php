<?php

namespace App\Observers;

use App\Models\UserNotification;

class UserNotificationObserver
{
    /**
     * Handle the UserNotification "created" event.
     *
     * @param UserNotification $userNotification
     * @return void
     */
    public function created(UserNotification $userNotification)
    {
        $userNotification->user()
            ->update(['notify' => true]);
    }


    /**
     * Handle the UserNotification "deleted" event.
     *
     * @param UserNotification $userNotification
     * @return void
     */
    public function deleted(UserNotification $userNotification)
    {
        if (! UserNotification::where('user_id', $userNotification->user_id)->exists()){
            $userNotification->user()
                ->update(['notify' => false]);
        }
    }

}
