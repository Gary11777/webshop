<div class="grid grid-cols-2 gap-10 mt-12 my-12">
    <div class="space-y-4">
        <div>
            <h1 class="text-3xl font-medium">{{ $this->product->name }}</h1>
            <div class="text-xl text-gray-700">{{ $this->product->price }}</div>

            <div class="text-gray-700 mt-4">
                {{ $this->product->description }}
            </div>

            <div class="mt-4 space-y-4">
                <select class="block w-full rounded-md border py-1.5 pl-3
                pr-10 text-gray-800">
                @foreach($this->product->variants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->size
                        }} / {{ $variant->color }} </option>
                @endforeach
                </select>
            </div>

            <div class="mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                    Add to Cart
                </button>
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg shadow-md">
            <img src="/{{ $this->product->image->path }}" alt="{{
        $this->product->name }}">
        </div>
        <div class="grid grid-cols-4 gap-4">
            @foreach($this->product->images as $image)
                    <div class="bg-white p-2 rounded shadow-md">
                        <img src="/{{ $image->path }}" alt="{{ $this->product->name }}">
                    </div>
            @endforeach
        </div>
    </div>

</div>
