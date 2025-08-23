@component('mail::message')
   
Hey **{{ $order->user->name ?? 'Customer' }}**,

Thank you for your order! You find your order details below: 
   
@component('mail::table')
| Item | Quantity | Price | Tax | Total |
|------|:--------:|:--------:|:-----:|--------:|
@foreach($order->items as $item)
| **{{ $item->name }}** <br> {{ $item->description }} | {{ $item->quantity }} | {{ $item->price }} | {{ $item->amount_tax }} | {{ $item->amount_total }} |
@endforeach
@if($order->amount_shipping)
|||| **Shipping** | {{ $order->amount_shipping ?? 0 }} |
@endif
@if($order->amount_discount->isPositive())
|||| **Discount** | {{ $order->amount_discount }} |
@endif
@if($order->amount_tax)
|||| **Tax** | {{ $order->amount_tax ?? 0 }} |
@endif
@if($order->amount_subtotal)
|||| **Subtotal** | {{ $order->amount_subtotal }} |
@endif
@if($order->amount_total)
|||| **Total** | {{ $order->amount_total }} |
@endif
@endcomponent

@component('mail::button', ['url' => route('view-order', $order->id), 'color' => 'success'])
View Order
@endcomponent

@endcomponent
