<tr class="hover:bg-neutral-50 transition">
    <td class="max-w-48 wrap-break-word px-6 py-4 font-medium">
        {{ $transaction->description}}
    </td>

    <td class="px-6 py-4 text-neutral-600">
        {{ $transaction->category}}
    </td>

    <td class="px-6 py-4">
        <span @class([ 'rounded-full px-2.5 py-1 text-xs font-medium' , $trxTypeClassText, $trxTypeClassBg, ])>
            {{ $trxTypeLabel }}
        </span>
    </td>
    <td @class(["px-6 py-4 text-right font-semibold", $trxTypeClassText])>
        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
    </td>

    <td class="px-6 py-4 text-neutral-500">
        {{ $transaction->created_at->format('d M Y') }} </td>

    <td class="px-6 py-4 text-right space-x-3">
        <a href="{{ route('transactions.edit', ['wallet' => $wallet, 'transaction'=> $transaction]) }}"
            class="text-sm font-medium text-neutral-700 hover:text-black">
            Edit
        </a>

        <form action="{{ route('transactions.destroy', ['wallet' => $wallet, 'transaction'=> $transaction]) }}"
            method="POST" class="inline-flex">
            @csrf
            @method('DELETE')

            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                Delete
            </button>
        </form>
    </td>
</tr>