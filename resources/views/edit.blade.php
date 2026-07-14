@php
use App\Enums\TransactionCategory;
use App\Enums\TransactionType;

$inputClass = 'w-full rounded-xl border border-neutral-300 px-4 py-3 transition
focus:border-neutral-900 focus:outline-none focus:ring-4 focus:ring-neutral-200';
@endphp

<x-layouts.app class="bg-neutral-100 text-neutral-900">
    <x-slot:app-title>
        {{ $appTitle }}
    </x-slot:app-title>

    <x-slot:app-description>
        {{ $appDescription }}
    </x-slot:app-description>

    <x-ui.header />

    <section class="mx-auto mt-8 max-w-3xl px-6">
        <form action="{{ route('transactions.update', ['wallet' => $wallet, 'transaction'=> $transaction]) }}"
            method="POST" class="overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm">
            @csrf
            @method('PATCH')

            <div class="border-b border-neutral-200 px-6 py-5">
                <h1 class="text-2xl font-semibold text-neutral-900">
                    Edit Transaction
                </h1>

                <p class="mt-1 text-sm text-neutral-500">
                    Update the details of your transaction.
                </p>
            </div>

            <div class="space-y-6 p-6">
                <div>
                    <label for="amount" class="mb-2 block text-sm font-medium text-neutral-700">
                        Amount
                    </label>

                    <input id="amount" name="amount" type="number" min="1" step="0.01"
                        value="{{ old('amount', $transaction->amount) }}" class="{{ $inputClass }}">

                    @error('amount')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="mb-2 block text-sm font-medium text-neutral-700">
                        Description
                    </label>

                    <textarea id="description" name="description" rows="4"
                        class="{{ $inputClass }} resize-none">{{ old('description', $transaction->description) }}</textarea>

                    @error('description')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="mb-2 block text-sm font-medium text-neutral-700">
                        Category
                    </label>

                    <select id="category" name="category" class="{{ $inputClass }}">
                        <option value="">Select category</option>

                        @foreach (TransactionCategory::cases() as $category)
                        <option value="{{ $category->value }}" @selected(old('category', $transaction->category->value)
                            === $category->value)>
                            {{ $category->label() }}
                        </option>
                        @endforeach
                    </select>

                    @error('category')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="mb-2 block text-sm font-medium text-neutral-700">
                        Type
                    </label>

                    <select id="type" name="type" class="{{ $inputClass }}">
                        <option value="">Select type</option>

                        @foreach (TransactionType::cases() as $type)
                        <option value="{{ $type->value }}" @selected(old('type', $transaction->type->value) ===
                            $type->value)>
                            {{ $type->label() }}
                        </option>
                        @endforeach
                    </select>

                    @error('type')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-neutral-200 px-6 py-4">
                <a href="{{ route('home') }}"
                    class="rounded-lg border border-neutral-300 px-4 py-2 hover:bg-neutral-50">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-lg bg-neutral-900 px-4 py-2 text-white transition hover:bg-neutral-800">
                    Save Changes
                </button>
            </div>
        </form>
    </section>
</x-layouts.app>