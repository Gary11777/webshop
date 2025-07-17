<div class="max-w-md mx-auto mt-10 p-6 rounded-lg shadow bg-white border border-gray-300 text-center text-base font-medium">
    @if($this->order)
        <span class="text-gray-800">
            Thank you for your order (#{{ $this->order->id }})
        </span>
    @else
        <span wire:poll class="text-gray-800">
            Waiting for payment confirmation. Please standby ...
        </span>
    @endif
</div>
