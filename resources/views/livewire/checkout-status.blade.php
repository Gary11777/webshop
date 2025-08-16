<div class="max-w-md mx-auto mt-10 p-6 rounded-lg shadow border text-center text-base font-medium">
    @if($paymentStatus === 'completed' && $this->order)
        <div class="bg-green-50 border-green-300 text-green-800">
            <div class="flex items-center justify-center mb-3">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-lg font-semibold mb-2">Payment Successful!</h2>
            <p class="mb-4">Thank you for your order (#{{ $this->order->id }})</p>
            <div class="text-sm text-green-700">
                <p>Order Total: ${{ number_format($this->order->amount_total / 100, 2) }}</p>
                <p>You will receive a confirmation email shortly.</p>
            </div>
            <a href="{{ route('home') }}" class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                Continue Shopping
            </a>
        </div>
    @elseif($paymentStatus === 'processing')
        <div class="bg-blue-50 border-blue-300 text-blue-800" wire:poll.3s="checkStatus">
            <div class="flex items-center justify-center mb-3">
                <svg class="animate-spin w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <h2 class="text-lg font-semibold mb-2">Processing Payment...</h2>
            <p class="mb-2">Please wait while we confirm your payment.</p>
            <p class="text-sm text-blue-700">This usually takes just a few seconds.</p>
        </div>
    @elseif($paymentStatus === 'failed')
        <div class="bg-red-50 border-red-300 text-red-800">
            <div class="flex items-center justify-center mb-3">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h2 class="text-lg font-semibold mb-2">Payment Failed</h2>
            <p class="mb-4">{{ $errorMessage ?? 'There was an issue processing your payment.' }}</p>
            <div class="space-y-2">
                <a href="{{ route('cart') }}" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
                    Return to Cart
                </a>
                <button wire:click="checkStatus" class="inline-block ml-2 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
                    Check Again
                </button>
            </div>
        </div>
    @endif
</div>
