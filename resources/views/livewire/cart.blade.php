<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-6 mt-12 w-[70%] mx-auto">
        <div class="overflow-x-auto">
            <table class="w-full table-fixed">
                <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 uppercase text-sm font-semibold text-gray-600">
                        Product
                    </th>
                    <th class="text-right py-3 px-4 uppercase text-sm font-semibold text-gray-600">
                        Quantity
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($this->items as $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="py-4 px-4">
                            <div class="flex flex-col gap-1">
                                <span class="font-medium text-gray-800">{{ optional($item->product)->name ?? 'N/A' }}</span>
                                <div class="text-sm text-gray-600">
                                    <span class="mr-2">Size: {{ $item->variant->size }}</span>
                                    <span>Color: {{ $item->variant->color }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 flex justify-end gap-4 items-center">
                            <span class="text-gray-700">{{ $item->quantity }}</span>
                            <button wire:click="delete({{ $item->id }})"
                                    class="p-1 hover:bg-red-50 rounded-full transition-colors duration-200"
                                    title="Remove item">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500 hover:text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
