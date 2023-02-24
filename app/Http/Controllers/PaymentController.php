<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatusType;
use DenizTezcan\LiqPay\Facades\LiqPay;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function liqpay(Request $request, Order $order)
    {
        $redirect = $request->get('redirect', '');

        return LiqPay::pay(
            $order->total,
            'UAH',
            "payment for order #{$order->id}",
            $order->id,
            $redirect,
            route('payment.callback.liqpay')
        );
    }

    public function callbackLiqpay(Request $request)
    {
        $data = $request->get('data', '');
        $payload = config('liqpay.private_key') . $data . config('liqpay.private_key');
        $sign = base64_encode(sha1($payload, 1));
        if (!$sign === $request->get('signature', '')) {
            logger('Liqpay error; check signature failed for data: ' . base64_decode($data));
            return response('failed');
        }
        try {
            $info = json_decode(base64_decode($data));
            if ('success' === $info->status
                && $order = Order::find($info->order_id)){
                $order->payment_status = Order::PAYMENT_STATUS_PAID;
                $order->status_id = OrderStatusType::STATUS_PROCESSING;
                $order->save();
            }

        } catch (\Exception $e){
            logger("Liqpay error; {$e->getMessage()}, for data: " . base64_decode($data));
            return response('failed');
        }

        return response('ok');
    }

}
