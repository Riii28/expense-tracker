<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function getAll()
    {
        return Transaction::query()->latest()->paginate(10)->withQueryString();
    }

    public function getTotal(TransactionType $type): float
    {
        return Transaction::query()
            ->where('type', $type)
            ->sum('amount');
    }


    public function store(string $balanceId, array $data): Transaction
    {
        return DB::transaction(function () use ($data, $balanceId) {
            $balance = Balance::query()
                ->lockForUpdate()
                ->findOrFail($balanceId);

            if (
                $data['type'] === TransactionType::EXPENSE &&
                $balance->amount < $data['amount']
            ) {
                throw new \RuntimeException('Insufficient balance.');
            }

            $transaction = $balance->transactions()->create([
                'amount' => $data['amount'],
                'category' => $data['category'],
                'type' => $data['type'],
            ]);

            match ($transaction->type) {
                TransactionType::INCOME => $balance->increment('amount', $transaction->amount),
                TransactionType::EXPENSE => $balance->decrement('amount', $transaction->amount),
            };

            return $transaction;
        });
    }
}
