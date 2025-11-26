<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\AsNumber;
use BcMath\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Number $balance
 */
class UserBalance extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'balance' => '0.00',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
             'balance' => AsNumber::class,
        ];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
