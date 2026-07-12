<?php

namespace App\Services;

use App\Models\Balance;

class BalanceService
{
    public function get(string $id)
    {
        return Balance::findOrFail($id);
    }
}
