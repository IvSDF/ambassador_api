<?php

namespace App\Http\Payments;

use App\Http\Payments\PaymentsInterface;
use Illuminate\Support\Facades\Http;

class LiqPayPayment implements PaymentsInterface
{

    public function pay()
    {
//            $liqpay = new LiqPay(env('LIQPAY_PUBLIC_KEY'), env('LIQPAY_PRIVATE_KEY'));
//            $html = $liqpay->cnb_form(array(
//                'action'         => 'pay',
//                'amount'         => '1',
//                'currency'       => 'UAH',
//                'description'    => 'description text',
//                'order_id'       => 'order_id_1',
//                'version'        => '3'
//            ));


        $prerequisites = \DigitalThreads\LiqPay\LiqPay::getCheckoutFormPrerequisites([
            'action'         => 'pay',
            'amount'         => '1',
            'currency'       => 'UAH',
            'description'    => 'description text',
            'order_id'       => 'order_id_1',
            'version'        => '3'
        ]);

        $response = Http::post($prerequisites->getAction(), [
            'data'      => $prerequisites->getData(),
            'signature' => $prerequisites->getSignature(),
        ]);

        dd($response);

        return $response;
    }
}
