<?php

namespace App\Enums\Transaction;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self user_charge_wallet()
 * @method static self management_update_balance()
 * @method static self pay_trip()
 * @method static self cancel_trip()
 * @method static self restore_money_from_cancel_trip()

 */
class TransactionReasonEnum extends Enum
{
}
