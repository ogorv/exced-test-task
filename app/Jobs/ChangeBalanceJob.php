<?php

namespace App\Jobs;

use App\Enums\PaymentTypeEnum;
use App\Models\User;
use App\Services\AmountGreaterThenBalanceException;
use App\Services\BalanceChanger;
use BcMath\Number;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

class ChangeBalanceJob implements ShouldQueue
{
    use Queueable;

    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly User $user,
        private readonly Number $amount,
        private readonly PaymentTypeEnum $paymentTypeEnum,
        private readonly string $description,
    ) {
    }

    /**
     * Execute the job.
     *
     * @throws Throwable
     */
    public function handle(BalanceChanger $balanceChanger): void
    {
        switch ($this->paymentTypeEnum) {
            case PaymentTypeEnum::DEPOSIT:
                $balanceChanger->depositToBalance($this->user, $this->amount, $this->description);
                break;
            case PaymentTypeEnum::WITHDRAW:
                $balanceChanger->withdrawFromBalance($this->user, $this->amount, $this->description);
        }
    }
}
