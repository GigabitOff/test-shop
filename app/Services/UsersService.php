<?php

namespace App\Services;

use App\Models\Counterparty;
use App\Models\PersonalOffer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersService
{
    public function customerPersonalOffersQuery(?User $user): \Illuminate\Database\Eloquent\Builder
    {
        $query = PersonalOffer::query()->onlyValid();

        if ($user) {
            if ($user->isCustomerLegal) {
                $sub = $user->counterparties()->select('id')->toRawSql();
                $query->where(function ($q) use ($sub) {
                    $q->where('for_all', true);
                    $q->orWhereHas('counterparties', fn($q1) => $q1->whereInRaw('id', $sub));
                });
            } else {
                $query->where(function ($q) use ($user) {
                    $q->where('for_all', true);
                    $q->orWhereRelation('users', 'id', '=', $user->id);
                });
            }
        } else {
            $query->where('for_all', true);
        }

        return $query;
    }

    public function transferManagerPermissions(int $fromUserId, int $toUserId): bool
    {
        try {
            DB::beginTransaction();
            DB::table('users')
                ->where('manager_id', $fromUserId)
                ->update(['manager_id' => $toUserId]);

            DB::table('chats')
                ->where('manager_id', $fromUserId)
                ->update(['manager_id' => $toUserId]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . ': error: ' . $e->getMessage(), func_get_args());
            return false;
        }

        return true;
    }

    /**
     * Переводим пользователя в режим удаленного для Юрлица.
     * @param User $user
     * @return void
     */
    public function deleteLegal(User $user)
    {
        $user->legal_deleted = true;
        $user->save();
    }

    /**
     * Восстанавливаем пользователя из режима удаленного для Юрлица.
     * @param User $user
     * @return void
     */
    public function restoreLegal(User $user)
    {
        $user->legal_deleted = false;
        $user->save();
    }

    /**
     * Открепляем пользователя от Юрлица (становится обычным пользователем)
     * @param User $user
     * @return void
     */
    public function detachLegalPermanently(User $user)
    {
        $user->counterparties()->detach();
        $user->is_admin = false;
        $user->legal_deleted = false;
        $user->save();
        $user->syncRoles(['simple']);
    }

    /**
     * Send sms with recovery code and save it in User model.
     * @param User $user
     * @param string|null $code
     * @return bool|mixed
     */
    public function sendRecoveryCode(User $user, ?string $code = null)
    {
        $code = $code ?? stringDigit(6);

        $response = smsSend($user->phone, sprintf(__('custom::site.new_password_sms'), $code), 'password recovery');
            
        if (false !== $response) {
            $user->recovery_code = $code;
            $user->save();
        }

        return $response;
    }

    /**
     * Replace password with recovery code.
     * @param User $user
     * @return bool
     */
    public function setPasswordFromRecoveryCode(User $user): bool
    {
        if ($pass = $user->recovery_code) {
            $user->password = bcrypt($pass);
            $user->recovery_code = null;
            return $user->save();
        }

        return false;
    }

    /**
     * Set new password for User.
     * @param User $user
     * @param string|null $pass
     * @return bool
     */
    public function setPassword(User $user, ?string $pass): bool
    {
        if ($pass) {
            $user->password = bcrypt($pass);
            return $user->save();
        }

        return false;
    }

    /**
     * Update User data
     * @param User $user
     * @param array $validated Only validated data
     * @return bool
     */
    public function updateUserData(User $user, array $validated): bool
    {
        try {
            $user->name = $validated['name'];
            $user->phone = $validated['phone'];
            $user->email = $validated['email'];
            $user->payment_type_id = $validated['payment_type_id'] ?? null;

            return $user->save();
        } catch (\Exception $e) {
        }

        return false;
    }

    public function registerNewCustomer(array $validated): bool
    {
        try {
            DB::beginTransaction();

            $user = new User;
            $user->name = $validated['name'];
            $user->phone = $validated['phone'];
            $user->email = $validated['email'];
            $user->city_id = $validated['city_id'];
            $user->customer_type = CustomerType::Simple;
            $user->password = bcrypt($validated['password']);

            $user->save();

            $user->assignRole('customer');

            if (!empty($validated['company_name'])) {
                $counterparty = new Counterparty();
                $counterparty->name = $validated['company_name'];
                $counterparty->okpo = $validated['edrpou'];
                $counterparty->is_nds = (bool)$validated['nds'];
                $counterparty->founder_id = $user->id;
                $counterparty->phone = $user->phone;
                $counterparty->save();

                $counterparty->users()->sync($user->id);

                $user->customer_type = CustomerType::Legal;
                $user->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return true;
    }
}
