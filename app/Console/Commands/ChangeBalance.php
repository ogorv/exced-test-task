<?php

namespace App\Console\Commands;

use App\Enums\PaymentTypeEnum;
use App\Jobs\ChangeBalanceJob;
use App\Models\User;
use App\Services\BalanceChanger;
use BcMath\Number;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Command\Command;

class ChangeBalance extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-balance {login} {amount} {paymentType} {description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change balance for user';

    /**
     * Execute the console command.
     */
    public function handle(BalanceChanger $balanceChanger): int
    {
        $login       = $this->argument('login');
        $amount      = $this->argument('amount');
        $paymentType = $this->argument('paymentType');
        $description = $this->argument('description');

        $isValidData = $this->validateData(
            [
                'login'       => $login,
                'amount'      => $amount,
                'paymentType' => $paymentType,
                'description' => $description,
            ],
            [
                'login'       => ['exists:users,login'],
                'amount'      => ['decimal:0,2'],
                'paymentType' => [Rule::enum(PaymentTypeEnum::class)],
                'description' => ['max:255'],
            ]
        );

        if (!$isValidData) {
            return Command::FAILURE;
        }

        $user = User::where('login', $login)->firstOrFail();

        ChangeBalanceJob::dispatch($user, new Number($amount), PaymentTypeEnum::from($paymentType), $description);

        $this->info('Job was created successfully!');

        return Command::SUCCESS;
    }
}
