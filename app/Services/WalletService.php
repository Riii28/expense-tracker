<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function storeTransaction(Wallet $wallet, array $data): Transaction
    {
        return DB::transaction(function () use ($wallet, $data) {
            $wallet = $this->lockWallet($wallet);

            $transaction = $wallet->transactions()->create($data);

            $this->applyTransaction($wallet, $transaction);

            return $transaction;
        });
    }

    public function updateTransaction(
        Wallet $wallet,
        Transaction $transaction,
        array $data,
    ): Transaction {
        return DB::transaction(function () use ($wallet, $transaction, $data) {
            $wallet = $this->lockWallet($wallet);
            $transaction = $this->lockTransaction($wallet, $transaction);

            $this->revertTransaction($wallet, $transaction);

            $transaction->update($data);
            $transaction->refresh();

            $this->applyTransaction($wallet, $transaction);

            return $transaction;
        });
    }

    public function deleteTransaction(
        Wallet $wallet,
        Transaction $transaction,
    ): bool {
        return DB::transaction(function () use ($wallet, $transaction) {
            $wallet = $this->lockWallet($wallet);
            $transaction = $this->lockTransaction($wallet, $transaction);

            $this->revertTransaction($wallet, $transaction);

            return (bool) $transaction->delete();
        });
    }

    protected function lockWallet(Wallet $wallet): Wallet
    {
        return Wallet::query()
            ->whereKey($wallet)
            ->lockForUpdate()
            ->firstOrFail();
    }

    protected function lockTransaction(
        Wallet $wallet,
        Transaction $transaction,
    ): Transaction {
        return $wallet->transactions()
            ->whereKey($transaction)
            ->lockForUpdate()
            ->firstOrFail();
    }

    protected function applyTransaction(
        Wallet $wallet,
        Transaction $transaction,
    ): void {
        match ($transaction->type) {
            TransactionType::INCOME => $wallet->increment('balance', $transaction->amount),
            TransactionType::EXPENSE => $wallet->decrement('balance', $transaction->amount),
        };
    }

    protected function revertTransaction(
        Wallet $wallet,
        Transaction $transaction,
    ): void {
        match ($transaction->type) {
            TransactionType::INCOME => $wallet->decrement('balance', $transaction->amount),
            TransactionType::EXPENSE => $wallet->increment('balance', $transaction->amount),
        };
    }
}
