@component('mail::message')
   <p>
   Hey {{ $order->user->name ?? 'Customer' }},
   </p>
   <p>
   Thank you for your order. You find your order details below: 
   </p>
   <table style="width: 100%;">
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Tax</th>
        <th>Total</th>
    </tr>
    @foreach($order->items as $item)
        <tr>
            <td>{{ $item->name }} <br>
                {{ $item->description ?? 'N/A' }}
            </td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->amount_tax }}</td>
            <td>{{ $item->amount_total }}</td>
        </tr>
    @endforeach
    @if($order->amount_shipping->isPositive())
        <tr>
            <td colspan="4" style="text-align: right;">Shipping costs</td>
            <td>{{ $order->amount_shipping }}</td>
        </tr>
    @endif
    @if($order->amount_discount->isPositive())
        <tr>
            <td colspan="4" style="text-align: right;">Discount</td>
            <td>{{ $order->amount_discount }}</td>
        </tr>
    @endif
    @if($order->amount_tax->isPositive())
        <tr>
            <td colspan="4" style="text-align: right;">Tax</td>
            <td>{{ $order->amount_tax }}</td>
        </tr>
    @endif
    @if($order->amount_subtotal->isPositive())
        <tr>
            <td colspan="4" style="text-align: right;">Subtotal</td>
            <td>{{ $order->amount_subtotal }}</td>
        </tr>
    @endif
    @if($order->amount_total->isPositive())
        <tr>
            <td colspan="4" style="text-align: right;">Total</td>
            <td>{{ $order->amount_total }}</td>
        </tr>
    @endif
   </table>
@endcomponent
