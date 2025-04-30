<div class="grid grid-cols-2 gap-10">
    <div>
        <div>
            <img src="/{{ $this->product->image->path }}" alt="{{
        $this->product->name }}"
                 class="w-full h-96 object-cover rounded-lg">
        </div>

        <div class="grid grid-cols-4 gap-4">
            @foreach($this->product->images as $image)
                    <img src="/{{ $image->path }}" alt="{{ $this->product->name }}"
                         class="rounded">
            @endforeach
        </div>

        <div>
            {{ $this->product->name }}
        </div>
    </div>

</div>
