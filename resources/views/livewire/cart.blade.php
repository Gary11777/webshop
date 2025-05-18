<div class="bg-white rounded-lg shadow p-5 mt-12">
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left">Product</th>
                <th class="text-left">Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->items as $item)
                <tr>
                    <td>
                        {{ optional($item->product)->name ?? 'N/A' }}
                        Size: {{ $item->variant->size }}
                        Color: {{ $item->variant->color }}
                    </td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
