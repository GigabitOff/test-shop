<?php

namespace App\Services;

use App\Models\IpFailedLogin;

class IpFailedLoginService
{
    public function addFailedLogin(string $phone)
    {
        return IpFailedLogin::create([
            'ip' => request()->ip(),
            'phone' => $phone,
        ]);
    }

    public function clearFailedLogins(string $phone)
    {
        return IpFailedLogin::query()
            ->where([
                'ip' => request()->ip(),
                'phone' => $phone,
            ])
            ->delete();
    }

    public function getFailedLoginsQuantity(string $phone): int
    {
        return IpFailedLogin::query()
            ->where([
                'ip' => request()->ip(),
                'phone' => $phone,
            ])
            ->count();
    }

    private function getHash(string $phone): string
    {
        return md5(json_encode([$phone, request()->ip()]));
    }
}
