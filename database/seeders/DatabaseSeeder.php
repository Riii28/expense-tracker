<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Balance::factory()
            ->has(Transaction::factory()->count(5))
            ->create();
    }
}
