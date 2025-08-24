<div class="grid grid-cols-2 gap-4">
    <x-panel class="mt-6 col-span-2" title="Your order #{{ $this->order->id }}">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product Details
                        </th>
                        <th class="text-center py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Qty
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Unit Price
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($this->order->items as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-6 px-6">
                                <div class="flex items-start space-x-4">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ $item->product->image->path }}" 
                                             alt="{{ $item->name }}"
                                             class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-900 mb-1">
                                            {{ $item->name ?? 'Unknown Product' }}
                                        </h4>
                                        @if($item->description)
                                            <p class="text-sm text-gray-600 line-clamp-2">
                                                {{ $item->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-6 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $item->quantity ?? 0 }}
                                </span>
                            </td>
                            <td class="py-6 px-6 text-right">
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $item->price ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-6 px-6 text-right">
                                <span class="text-sm font-semibold text-gray-900">
                                    {{ $item->amount_total ?? 'N/A' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">No items found in this order</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-50 border-t border-gray-200">
                    <tr>
                        <td colspan="3" class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-700">Subtotal:</span>
                        </td>
                        <td class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-900">
                                {{ $this->order->amount_subtotal ?? 'N/A' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-700">Shipping:</span>
                        </td>
                        <td class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-900">
                                {{ $this->order->amount_shipping ?? 'Free' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-700">Discount:</span>
                        </td>
                        <td class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-900">
                                {{ $this->order->amount_discount ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-700">Tax:</span>
                        </td>
                        <td class="py-2 px-6 text-right">
                            <span class="text-sm font-medium text-gray-900">
                                {{ $this->order->amount_tax ?? 'N/A' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-300">
                        <td colspan="3" class="py-4 px-6 text-right">
                            <span class="text-base font-semibold text-gray-900">Order Total:</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <span class="text-base font-bold text-gray-900">
                                {{ $this->order->amount_total ?? 'N/A' }}
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </x-panel>

    <x-panel class="col-span-1" title="Billing Information">
        @foreach ($this->order->billing_address->filter() as $address)
            {{ $address }} <br>

        @endforeach
    </x-panel>

    <x-panel class="col-span-1" title="Shipping Information">
        @foreach ($this->order->shipping_address->filter() as $address)
            {{ $address }} <br>
        @endforeach
    </x-panel>
</div>
