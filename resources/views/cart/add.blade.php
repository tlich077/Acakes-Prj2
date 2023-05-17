<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@foreach (auth()->user()->cartItems as $cartItem)
    <tr>
        <td>{{ $cartItem->product->name }}</td>
        <td>{{ $cartItem->product->price }}</td>
        <td>{{ $cartItem->quantity }}</td>
        <td>{{ $cartItem->product->price * $cartItem->quantity }}</td>
    </tr>
@endforeach
</body>
</html>