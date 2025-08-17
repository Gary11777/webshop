<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation #{{ $order->id }}</title>
</head>
<body>
   <p>
   Hey {{ $order->user->name ?? 'Customer' }},
   </p>
   <p>
   Your order #{{ $order->id }} has been received and is being processed.
   </p>
</body>
</html>