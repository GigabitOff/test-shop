<?php

namespace App\Services;

use App\Models\VerificationCode;

class OtpService
{
    public function validate(string $target, string $value): bool
    {
        if($target === '' || $value === ''){
            return false;
        }

        $code = VerificationCode::whereTarget($target)->latest()->first();

        if (null === $code || $value !== $code->value || $code->isExpired() || $code->isUsed()) {
            return false;
        }

        return true;
    }

    /**
     * @throws \Exception
     */
    public function generate(string $target, int $attempts = 0): string
    {
        if($target === ''){
            throw(new \Exception('Target required.'));
        }

        try {
            $code = VerificationCode::create([
                'target' => $target,
                'value' => stringDigit(6),
                'expired_at' => now()->addHour(),
            ]);

            return $code->value;
        } catch (\Exception $e){
            logger("OTP code error: for {$target}; " . $e->getMessage());

            if($attempts < 2){
                return $this->generate($target, ++$attempts);
            }
        }
    }

    public function markCodeAsUsed(string $target, string $value): void
    {
        $code = VerificationCode::whereTarget($target)->whereValue($value)->first();

        $code->used_at = now();
        $code->save();
    }
}
