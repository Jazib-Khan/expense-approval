<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Create An Expense') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form wire:submit.prevent="submitExpense" class="py-12  shadow-md rounded">
                    <div class="mb-4">
                        <label class="block text-white-700">Description</label>
                        <input type="text" wire:model="description" class="w-full border rounded p-2 bg-gray-500" required>
                        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-white-700">Amount</label>
                        <input type="number" wire:model="amount" step="0.01" class="w-full border rounded p-2 bg-gray-500" required>
                        @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-white-700">Category</label>
                        <input type="text" wire:model="category" class="w-full border rounded p-2 bg-gray-500" required>
                        @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-white-700">Receipt</label>
                        <input type="file" wire:model="receipt_image" class="w-full border rounded p-2 bg-gray-500">
                        @error('receipt') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded">Submit Expense</button>
                </form>
            </div>
        </div>
    </div>
</div>
