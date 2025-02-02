<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Expenses') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl text-gray-200 font-bold mb-4">Employee Expense Requests</h2>
                <div class="mb-4">
                    <input type="text" wire:model.live="search"
                           placeholder="Search by Employee Name..."
                           class="w-full p-2 border rounded bg-gray-700 text-white">
                </div>
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="text-gray-200">
                            <th class="border p-2">Employee</th>
                            <th class="border p-2">Description</th>
                            <th class="border p-2">Amount</th>
                            <th class="border p-2">Category</th>
                            <th class="border p-2">Receipt Image</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr class="text-gray-200">
                            <td class="border p-2">{{ $expense->user->name }}</td>
                            <td class="border p-2">{{ $expense->description }}</td>
                            <td class="border p-2">{{ $expense->amount }}</td>
                            <td class="border p-2">{{ $expense->category }}</td>
                            <td class="border p-2">
                                @if ($expense->receipt_image)
                                    <img src="/storage/{{ $expense->receipt_image }}" alt="Receipt Image" class="w-20 h-20 object-cover">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td class="border p-2">{{ ucfirst($expense->status) }}</td>
                            <td class="border p-2 flex justify-center gap-4">
                                <button wire:click="updateExpenseStatus({{ $expense->id }}, 'approved')" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Approve</button>
                                <button wire:click="updateExpenseStatus({{ $expense->id }}, 'rejected')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Reject</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $expenses->links() }}

            </div>
        </div>
    </div>
</div>
