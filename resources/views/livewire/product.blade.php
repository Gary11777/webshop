<div class="grid grid-cols-2 gap-10 mt-12 my-12">
    <!-- Image Section -->
    <div class="space-y-4" x-data="{ image: @js('/' . $this->product->image->path) }">
        <!-- Main Product Image -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <img
                x-bind:src="image"
                :alt="'Main image of ' + @js($this->product->name)"
                class="rounded-lg w-full object-cover max-h-80"
            >
        </div>

        <!-- Thumbnail Images -->
        <div class="grid grid-cols-4 gap-4">
            @foreach($this->product->images as $image)
                <div class="bg-white p-2 rounded shadow-md cursor-pointer">
                    <img
                        src="/{{ $image->path }}"
                        @click="image = '/{{ $image->path }}'"
                        alt="{{ $this->product->name }}"
                        class="rounded object-cover h-24 w-full"
                    >
                </div>
            @endforeach
        </div>
    </div>

    <!-- Product Details Section -->
    <div>
        <!-- Product Name -->
        <h1 class="text-3xl font-medium text-gray-800">{{ $this->product->name }}</h1>

        <!-- Product Price -->
        <div class="text-xl text-gray-700 my-2">
            {{ $this->product->price }}
        </div>

        <!-- Product Description -->
        <div class="text-gray-700 my-4">
            {{ $this->product->description }}
        </div>

        <!-- Variant Selector -->
        <div class="mt-4 space-y-4">
            <select
                wire:model="variant"
                class="block w-full rounded-md border py-1.5 pl-3
                pr-10 text-gray-800 focus:ring focus:ring-blue-500">
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">
                        {{ $variant->size }} / {{ $variant->color }}
                    </option>
                @endforeach
            </select>

            @error('variant')
                <div class="mt-2 text-red-600">
                    {{ $message }}
                </div>
            @enderror

            <!-- Banner -->
            @if (session('banner'))
                <x-banner>
                    {{ session('banner.message') }}
                </x-banner>
            @endif
        </div>

        <!-- Add to Cart Button -->
        <div class="mt-4 space-y-4">
            <x-button wire:click="addToCart">Add to cart</x-button>
        </div>
    </div>

</div>
