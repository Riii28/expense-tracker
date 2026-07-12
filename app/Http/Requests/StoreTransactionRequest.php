<?php

namespace App\Http\Requests;

use App\Enums\TransactionCategory;
use App\Enums\TransactionType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'float'],
            'category' => ['required', Rule::enum(TransactionCategory::class)],
            'type' => ['required', Rule::enum(TransactionType::class)],
            'description' => ['required', 'string']
        ];
    }
}
