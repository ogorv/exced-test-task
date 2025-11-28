<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class UserBalanceHistory extends Model
{
    use Searchable;

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


    public function toSearchableArray(): array
    {
        return [
            'description' => $this->description,
        ];
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    //#[SearchUsingFullText(['description'])] Uncomment and add fulltext index for fulltext search
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'payment_type' => PaymentTypeEnum::class,
            'created_at'   => 'datetime:Y-m-d H:i:s',
        ];
    }

}
