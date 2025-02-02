<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Your Expenses') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl text-gray-200 font-bold mb-4">My Expense Requests</h2>
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="text-gray-200">
                            <th class="border p-2">Description</th>
                            <th class="border p-2">Amount</th>
                            <th class="border p-2">Category</th>
                            <th class="border p-2">Receipt Image</th>
                            <th class="border p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr class="text-gray-200">
                            <td class="border p-2">{{ $expense->description }}</td>
                            <td class="border p-2">{{ $expense->amount }}</td>
                            <td class="border p-2">{{ $expense->category }}</td>
                            <td class="border p-2">
                                @if ($expense->receipt_image)
                                    <img src="storage/{{ $expense->receipt_image }}" alt="Receipt Image" class="w-20 h-20 object-cover">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td class="border p-2">{{ ucfirst($expense->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
