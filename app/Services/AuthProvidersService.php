<?php

namespace App\Services;

use App\Models\Counterparty;
use App\Models\User;
use Illuminate\Support\Str;

class AuthProvidersService
{
    /**
     * Обновляет пользователя или создает простого пользователя
     *
     * @param  $sUser
     * @return User
     */
    public function newOrUpdateSimpleUser($sUser): User
    {
        // check if they're an existing user
        $user = User::where('email', $sUser->email)->first();
        if ($user) {
            if (!$user->name){
                $user->name = $sUser->name ?? $sUser->email;
            }
            if (!$user->avatar_url){
                $user->avatar_url = $sUser->avatar;
            }
            $user->save();
        } else {
            // create a new user
            $user = new User;
            $user->name = $sUser->name ?? $sUser->email;
            $user->email = $sUser->email;
            $user->password = bcrypt(Str::random(8));
            $user->avatar_url = $sUser->avatar;

            $user->save();
            $user->assignRole('simple');
        }

        return $user;
    }

    /**
     * Обновляет пользователя или создает пользователя контрагента
     *
     * @param $sUser
     * @return User
     */
    public function newOrUpdateLegalUser($sUser): User
    {
        // check if they're an existing user
        /** @var User|null $user */
        $user = User::query()->where('phone', $sUser->phone)->first()
            ?? User::query()->where('email', $sUser->email)->first();

        if ($user) {
            if (!$user->name){
                $user->name = $sUser->name;
            }
            if (!$user->phone){
                $user->phone = $sUser->phone;
                $user->password = bcrypt(Str::random(8));
            }
            if (!$user->email && User::whereEmail($sUser->email)->count() === 0){
                $user->email = $sUser->email;
            }
            if (!$user->avatar_url){
                $user->avatar_url = $sUser->avatar;
            }

            $user->save();

        } else {
            // create a new user
            $user = new User;
            $user->name = $sUser->name;
            $user->phone = $sUser->phone;
            $user->email = $sUser->email;
            $user->password = bcrypt(Str::random(8));
            $user->avatar_url = $sUser->avatar;

            $user->save();
            $user->assignRole('simple');
        }

        if (($sUser->okpo || $sUser->inn) && !$user->counterparties()->exists()){
            $counterparty = new Counterparty();
            $counterparty->name = $sUser->company ?? $sUser->name;
            $counterparty->okpo = $sUser->okpo ?? $sUser->inn;
            $counterparty->founder()->associate($user);
            $counterparty->save();

            $user->counterparties()->sync($counterparty->id);
        }

        return $user;
    }
}
