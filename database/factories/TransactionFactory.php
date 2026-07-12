<?php

namespace Database\Factories;

use App\Enums\TransactionCategory;
use App\Enums\TransactionType;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(1_000, 100_000),
            'category' => $this->faker->randomElement(TransactionCategory::cases()),
            'type' => $this->faker->randomElement(TransactionType::cases()),
            'description' => $this->faker->sentence(2)
        ];
    }
}
