<?php

namespace App\Listeners;

use App\Events\OrderComplitedEvant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminListener
{
    public function handle(OrderComplitedEvant $event): void
    {
        $order = $event->order;

        \Mail::send('email/admin', ['order' => $order], function (Message $message){
            $message->subject('A order has been completed');
            $message->to("admin@admin.com");
        });
    }
}
