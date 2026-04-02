<?php

namespace App\Listeners;

use App\Events\PaymentMethodEvent;
use App\Models\PaymentMethodTransaction;

class PaymentMethodTransactionListner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentMethodEvent $event): void
    {
        $data = $event->data;
        PaymentMethodTransaction::create([
            'payment_method_id' => $data['payment_id'],
            'amount' => $data['amount'],
            'operation' => $data['operation'],
            'description' => $data['description'],
        ]);
    }
}
