@component('mail::message')
   
Hey **{{ $cart->user->name ?? 'Customer' }}**,

You still have items in your cart. Click the button below to continue your checkout.
   


@component('mail::button', ['url' => route('cart'), 'color' => 'success'])
Continue Checkout
@endcomponent

@endcomponent