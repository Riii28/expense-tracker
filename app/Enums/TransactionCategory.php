<?php

namespace App\Enums;

enum TransactionCategory: string
{
    case FOOD = 'food';
    case TRANSPORTATION = 'transportation';

    public function label()
    {
        return str($this->value)->replace('_', ' ')->title();
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
