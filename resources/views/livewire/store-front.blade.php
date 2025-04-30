<div class="grid grid-cols-4 gap-7 mt-5">
    @foreach($this->products as $product)
        <div class="bg-white rounded-lg shadow-md p-4 flex flex-col
        items-center relative">
            <a href="{{ route('product', $product) }}" class="absolute inset-0 w-full
            h-full"></a>
            <img src="{{ $product->image->path }}" alt="{{ $product->name
            }} image">
            <h2 class="font-medium text-lg">{{ $product->name }}</h2>
{{--            <p>{{ $product->description }}</p>--}}
            <span class="text-gray-700 text-sm">{{ $product->price
            }}</span>
{{--            <button wire:click="addToCart({{ $product->id }})">Add to Cart</button>--}}
        </div>

    @endforeach
</div>
