<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\AsNumber;
use App\Enums\PaymentTypeEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * @property ?Number $amount
 */
class UserBalanceHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_balance_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'amount', 'payment_type', 'description'];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'payment_type' => PaymentTypeEnum::class,
            'amount'       => AsNumber::class,
        ];
    }
}
