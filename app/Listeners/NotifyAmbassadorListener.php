<?php

namespace App\Listeners;

use App\Events\OrderComplitedEvant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAmbassadorListener
{
    public function handle(OrderComplitedEvant $event): void
    {
        $order = $event->order;

        \Mail::send('email/ambassador', ['order' => $order], function (Message $message) use($order){
            $message->subject('A order has been completed');
            $message->to($order->ambassador_email);
        });
    }
}
