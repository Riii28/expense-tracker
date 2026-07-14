<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function getAll(User $user): LengthAwarePaginator
    {
        return $this->balance($user)
            ->transactions()
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getTotal(User $user, TransactionType $type): float
    {
        return (float) $this->balance($user)
            ->transactions()
            ->where('type', $type)
            ->sum('amount');
    }

    public function get(User $user, string $transactionId): Transaction
    {
        return $this->balance($user)
            ->transactions()
            ->whereKey($transactionId)
            ->firstOrFail();
    }

    public function store(User $user, array $data): Transaction
    {
        return DB::transaction(function () use ($user, $data) {
            $balance = $this->balanceForUpdate($user);

            $transaction = $balance->transactions()->create($data);

            $this->applyTransaction($balance, $transaction);

            return $transaction;
        });
    }

    public function update(User $user, string $transactionId, array $data): Transaction
    {
        return DB::transaction(function () use ($user, $transactionId, $data) {
            $balance = $this->balanceForUpdate($user);

            $transaction = $balance->transactions()
                ->whereKey($transactionId)
                ->lockForUpdate()
                ->firstOrFail();

            $this->revertTransaction($balance, $transaction);
            $transaction->update($data);
            $transaction->refresh(); 
            $this->applyTransaction($balance, $transaction);

            return $transaction;
        });
    }
  
    public function delete(User $user, string $transactionId): bool
    {
        return DB::transaction(function () use ($user, $transactionId) {
            $balance = $this->balanceForUpdate($user);

            $transaction = $balance->transactions()
                ->whereKey($transactionId)
                ->lockForUpdate()
                ->firstOrFail();

            $this->revertTransaction($balance, $transaction);

            return $transaction->delete();
        });
    }

    private function balance(User $user): Balance
    {
        return $user->balance()->firstOrFail();
    }

    private function balanceForUpdate(User $user): Balance
    {
        return Balance::query()
            ->where('user_id', $user->id)
            ->lockForUpdate()
            ->firstOrFail();
    }

    private function applyTransaction(Balance $balance, Transaction $transaction): void
    {
        match ($transaction->type) {
            TransactionType::INCOME => $balance->increment('amount', $transaction->amount),
            TransactionType::EXPENSE => $balance->decrement('amount', $transaction->amount),
        };
    }

    private function revertTransaction(Balance $balance, Transaction $transaction): void
    {
        match ($transaction->type) {
            TransactionType::INCOME => $balance->decrement('amount', $transaction->amount),
            TransactionType::EXPENSE => $balance->increment('amount', $transaction->amount),
        };
    }
}
