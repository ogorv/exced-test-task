<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\SortEnum;
use App\Models\UserBalanceHistory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    private const int LAST_PAYMENTS_LIMIT = 5;

    public function index(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'balance'  => $request->user()->balance?->balance ? (string)$request->user()->balance?->balance : '0.00',
            'payments' => UserBalanceHistory::select('payment_type', 'amount', 'description', 'created_at')
                                            ->where('user_id', $request->user()->id)
                                            ->orderBy('created_at', SortEnum::DESC->value)
                                            ->limit(self::LAST_PAYMENTS_LIMIT)
                                            ->get()
        ]);
    }
}
