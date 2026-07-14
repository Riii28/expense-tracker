<?php

namespace App\Services;

use App\Models\Balance;
use App\Models\User;

class BalanceService
{
    public function get(User $user): Balance
    {
        return $user->balance()->firstOrFail();
    }
}
