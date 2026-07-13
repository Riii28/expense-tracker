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
        return Transaction::query()
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getTotal(TransactionType $type): float
    {
        return Transaction::query()
            ->where('type', $type)
            ->sum('amount');
    }

    public function get(string $id, string $balanceId): Transaction
    {
        return Transaction::query()
            ->whereKey($id)
            ->where('balance_id', $balanceId)
            ->firstOrFail();
    }

    public function store(string $balanceId, array $data): Transaction
    {
        return DB::transaction(function () use ($balanceId, $data) {
            $balance = Balance::query()
                ->lockForUpdate()
                ->findOrFail($balanceId);

            $transaction = $balance->transactions()->create($data);

            $this->applyTransaction($balance, $transaction);

            return $transaction;
        });
    }

    public function update(string $id, string $balanceId, array $data): Transaction
    {
        return DB::transaction(function () use ($id, $balanceId, $data) {
            $balance = Balance::query()
                ->lockForUpdate()
                ->findOrFail($balanceId);

            $transaction = Transaction::query()
                ->whereKey($id)
                ->where('balance_id', $balanceId)
                ->lockForUpdate()
                ->firstOrFail();

            // Batalkan pengaruh transaksi lama terhadap saldo.
            $this->revertTransaction($balance, $transaction);

            // Update data transaksi.
            $transaction->update($data);

            // Muat ulang model agar enum/cast ikut diperbarui.
            $transaction->refresh();

            // Terapkan pengaruh transaksi baru terhadap saldo.
            $this->applyTransaction($balance, $transaction);

            return $transaction;
        });
    }

    public function delete(string $id, string $balanceId): bool
    {
        return DB::transaction(function () use ($id, $balanceId) {
            $balance = Balance::query()
                ->lockForUpdate()
                ->findOrFail($balanceId);

            $transaction = Transaction::query()
                ->whereKey($id)
                ->where('balance_id', $balanceId)
                ->lockForUpdate()
                ->firstOrFail();

            $this->revertTransaction($balance, $transaction);

            return $transaction->delete();
        });
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
