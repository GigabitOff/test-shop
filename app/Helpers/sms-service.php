<?php
/**
 * SmsService Helpers
 */

use App\Modules\Sms\Facades\SmsService;

if ( ! function_exists( 'smsSend' ) ) {
    function smsSend($recipient, $message, $description = '')
    {
        return SmsService::driver('turbosms')->sendMessage($recipient, $message, $description);
    }
}

if ( ! function_exists( 'smsBalance' ) ) {
    function smsBalance()
    {
        return SmsService::driver('turbosms')->getBalance();
    }
}
