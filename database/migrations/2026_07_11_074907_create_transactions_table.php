<?php

use App\Enums\TransactionCategory;
use App\Enums\TransactionType;
use App\Models\Balance;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuidFor(Balance::class)->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->enum('category', TransactionCategory::values());
            $table->enum('type', TransactionType::values());
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
