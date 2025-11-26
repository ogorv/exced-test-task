<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PaymentTypeEnum;
use App\Models\User;
use App\Models\UserBalance;
use App\Models\UserBalanceHistory;
use BcMath\Number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BalanceChanger
{
    /** @throws Throwable */
    public function depositToBalance(User $user, Number $amount, string $description): void
    {
        DB::transaction(static function () use ($user, $amount, $description) {
            $userBalance          = $user?->balance ?? new UserBalance(['user_id' => $user->id]);
            $userBalance->balance += $amount;
            $userBalance->save();

            UserBalanceHistory::create([
                'user_id'      => $user->id,
                'amount'       => $amount,
                'payment_type' => PaymentTypeEnum::DEPOSIT,
                'description'  => $description,
            ]);
        });
    }

    /** @throws Throwable */
    public function withdrawFromBalance(User $user, Number $amount, string $description): void
    {
        DB::transaction(static function () use ($user, $amount, $description) {
            if ($user?->balance === null || $user?->balance->balance < $amount) {
                // Send user notification of failure, etc...
                Log::error('Withdraw balance error. Amount is greater than the balance of the user id - '.$user->id);

                return;
            }

            $user->balance->balance -= $amount;
            $user->balance->save();

            UserBalanceHistory::create([
                'user_id'      => $user->id,
                'amount'       => $amount,
                'payment_type' => PaymentTypeEnum::WITHDRAW,
                'description'  => $description,
            ]);
        });
    }
}
