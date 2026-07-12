<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService {
    public function getAll(int $limit) {
        return Transaction::query();
    }
}