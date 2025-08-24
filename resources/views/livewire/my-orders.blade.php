<div class="max-w-6xl mx-auto">
    <x-panel title="My Orders">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order #
                        </th>
                        <th class="text-center py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="text-center py-4 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($this->orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-6 px-6">
                                <span class="text-sm font-semibold text-gray-900">
                                    #{{ $order->id }}
                                </span>
                            </td>
                            <td class="py-6 px-6 text-center">
                                <span class="text-sm text-gray-600">
                                    {{ $order->created_at->format('M d, Y') }}
                                </span>
                                <br>
                                <span class="text-xs text-gray-400">
                                    {{ $order->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td class="py-6 px-6 text-right">
                                <span class="text-sm font-semibold text-gray-900">
                                    {{ $order->amount_total ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-6 px-6 text-center">
                                <a href="{{ route('view-order', $order->id) }}" 
                                   class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-150"
                                   wire:navigate>
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">No orders found</p>
                                    <a href="{{ route('home') }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                                       wire:navigate>
                                        Start Shopping
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-panel>
</div>
