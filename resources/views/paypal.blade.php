<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Integration</title>
</head>
<body>
@if (session()->has('add'))
    <div class="alert alert-success alert-dismissible fade show " role="alert">
        <strong>{{ session()->get('add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<h2>Product: Mobile Phone</h2>
<div style="margin-bottom:10px;">
    <form action="{{ route('paypal') }}" method="post">
        @csrf
        <label style="font-size: 25px">Currency:</label>
        <select style="font-size: 15px" name="currency">
            <option value="USD">United States Dollar (USD)</option>
            <option value="EUR">Euro (EUR)</option>
            <option value="JPY">Japanese Yen (JPY)</option>
        </select>
        <br>
        <label style="font-size: 25px">Price:</label>
        <input style="font-size: 15px" type="text" name="price" placeholder="enter the price here">
        <br>
        <br>
        <button style="font-size: 15px" type="submit">Pay With PayPal</button>
    </form>
</div>

{{--<div style="margin-bottom:10px;">--}}
{{--    <form action="{{ route('stripe') }}" method="post">--}}
{{--        @csrf--}}
{{--        <input type="hidden" name="price" value="199">--}}
{{--        <button type="submit">Pay With Stripe</button>--}}
{{--    </form>--}}
{{--</div>--}}

</body>
</html>

