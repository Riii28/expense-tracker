<?php

namespace App\Enums;

enum TransactionCategory: string
{
    case SALARY = 'salary';
    case BONUS = 'bonus';
    case FREELANCE = 'freelance';
    case BUSINESS = 'business';
    case INVESTMENT = 'investment';
    case GIFT = 'gift';
    case REFUND = 'refund';
    case OTHER_INCOME = 'other_income';

    case FOOD = 'food';
    case TRANSPORTATION = 'transportation';
    case SHOPPING = 'shopping';
    case ENTERTAINMENT = 'entertainment';
    case BILLS = 'bills';
    case RENT = 'rent';
    case HEALTH = 'health';
    case EDUCATION = 'education';
    case TRAVEL = 'travel';
    case SUBSCRIPTION = 'subscription';
    case INSURANCE = 'insurance';
    case TAX = 'tax';
    case CHARITY = 'charity';
    case PERSONAL_CARE = 'personal_care';
    case OTHER_EXPENSE = 'other_expense';

    public function label(): string
    {
        return str($this->value)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
