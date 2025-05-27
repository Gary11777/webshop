<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-6 mt-12 w-full mx-auto">
        <div class="overflow-x-auto">
            <table class="w-full table-fixed">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left py-3 px-4 uppercase text-sm font-semibold text-gray-600">
                        Product
                    </th>
                    <th class="text-center py-3 px-4 uppercase text-sm
                    font-semibold text-gray-600">
                        Price
                    </th>
                    <th class="text-center py-3 px-4 uppercase text-sm font-semibold text-gray-600">
                        Color
                    </th>
                    <th class="text-center py-3 px-4 uppercase text-sm font-semibold text-gray-600">
                        Size
                    </th>
                    <th class="text-right py-3 px-4 uppercase text-sm font-semibold text-gray-600">
                        Quantity
                    </th>
                    <th class="text-right py-3 px-4 uppercase text-sm font-semibold text-gray-600">
                        Subtotal
                    </th>
                    <th class="text-right py-3 px-4 uppercase text-sm
                    font-semibold text-gray-600">
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($this->items as $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="py-4 px-4">
                            <div class="flex flex-col gap-1">
                                <span
                                    class="font-medium text-gray-800">{{ optional($item->product)->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="text-center py-4 px-4">
                            {{ $item->product->price ?? 'N/A' }}
                        </td>
                        <td class="text-center py-4 px-4">
                            {{ $item->variant->color ?? 'N/A' }}
                        </td>
                        <td class="text-center py-4 px-4">
                            {{ $item->variant->size ?? 'N/A' }}
                        </td>
                        <td class="py-4 px-4 flex justify-end gap-4 items-center">
                            <button
                                wire:click="decrement({{ $item->id }})"
                                class="p-1 bg-gray-100 hover:bg-gray-300
                                hover:cursor-pointer rounded-full
                                        transition-colors duration-200"
                                @disabled($item->quantity === 1)>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="size-3">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round" d="M5 12h14"/>
                                </svg>
                            </button>
                            <span
                                class="text-gray-700">{{ $item->quantity }}</span>
                            <button
                                wire:click="increment({{ $item->id }})"
                                class="p-1 bg-gray-100 hover:bg-gray-300
                                hover:cursor-pointer rounded-full
                            transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="size-3">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                            </button>
                        </td>
                        <td class="text-center py-4 px-4">
                            {{ $item->subtotal ?? 'N/A' }}
                        </td>
                        <td class="text-center py-4 px-4">
                            <button wire:click="delete({{ $item->id }})"
                                    class="p-1 hover:bg-red-50 hover:cursor-pointer rounded-full
                                    transition-colors duration-200"
                                    title="Remove item">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500 hover:text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 mt-12 w-full mx-auto">
        @guest
            <x-auth-guest-message />
        @endguest
        @auth
                <div class="flex justify-between items-center">
                    <span class="text-gray-800 font-semibold text-lg">Total:</span>
                    <span class="text-gray-800 font-bold text-xl">$ {{ $this->total ??
             'N\A' }}</span>
                </div>
                <div class="mt-4">
                    <x-button wire:click="checkout" class="bg-blue-600
                    text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-200">
                        Checkout
                    </x-button>
                </div>
        @endauth
    </div>
</div>
