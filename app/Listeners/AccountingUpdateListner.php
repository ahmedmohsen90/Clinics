<?php

namespace App\Listeners;

use App\Events\AccountingEvent;
use App\Models\Accounting;

class AccountingUpdateListner
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
    public function handle(AccountingEvent $event): void
    {
        $data = $event->data;
        $accounting = Accounting::where([
            'accountingable_type' => $data["accountingable_type"],
            'accountingable_id' => $data["accountingable_id"],
            'operation' => $data["operation"]
        ])->first();

        if ($accounting) {
            $amount = $accounting->amount;
            $accounting->amount = $amount + $data["amount"];
            $accounting->save();
        } else {
            Accounting::create([
                'company_id' => session('company_id'),
                'accountingable_type' => $data["accountingable_type"],
                'accountingable_id' => $data["accountingable_id"],
                'operation' => $data["operation"],
                'amount' => $data["amount"]
            ]);
        }

        if ($data["operation"] == "plus") {
            $oldAmount = Accounting::where([
                'accountingable_type' => $data["accountingable_type"],
                'accountingable_id' => $data["accountingable_id"],
                'operation' => 'minus'
            ])->first();
            if ($oldAmount) {
                $oldAmount->amount = $oldAmount->amount - $data["amount"];
                $oldAmount->save();
            }
        }
    }
}
