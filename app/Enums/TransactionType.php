<?php

namespace App\Enums;

enum TransactionType: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';

    public function label()
    {
        return str($this->value)->replace('_', ' ')->title();
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
