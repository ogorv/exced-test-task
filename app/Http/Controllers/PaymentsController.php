<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\SortEnum;
use App\Http\Requests\PaymentsRequest;
use App\Models\UserBalanceHistory;
use Inertia\Inertia;
use Inertia\Response;

class PaymentsController extends Controller
{
    public function index(PaymentsRequest $request): Response
    {
        $validated   = $request->validated();
        $description = $validated['description'] ?? null;
        $sort        = $validated['sort'] ?? SortEnum::DESC->value;

        return Inertia::render('Payments', props: [
            'payments' => UserBalanceHistory
                ::search($description)
                ->where('user_id', $request->user()->id)
                ->orderBy('created_at', $sort)
                ->get()
                ->map(
                    function (UserBalanceHistory $userBalanceHistory) {
                        return [
                            'payment_type' => $userBalanceHistory->payment_type,
                            'amount'       => $userBalanceHistory->amount,
                            'description'  => $userBalanceHistory->description,
                            'created_at'   => $userBalanceHistory->created_at?->format('Y-m-d H:i:s'),
                        ];
                    }
                )
        ]);
    }
}
