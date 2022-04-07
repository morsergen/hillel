@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>{{ __('Thanks for shopping in our store') }}</h3>
        </div>
        <hr>
        <div class="col-md-4">
            <h4>{{ __('Order №') . $order->id }}</h4>
            <div class="row">
                <div class="col-md-6">Name</div>
                <div class="col-md-6">{{ $order->name }}</div>
            </div>
            <div class="row">
                <div class="col-md-6">Surname</div>
                <div class="col-md-6">{{ $order->surname }}</div>
            </div>
            <div class="row">
                <div class="col-md-6">Phone</div>
                <div class="col-md-6">{{ $order->phone }}</div>
            </div>
            <div class="row">
                <div class="col-md-6">Email</div>
                <div class="col-md-6">{{ $order->email }}</div>
            </div>
            <div class="row">
                <div class="col-md-6">Country</div>
                <div class="col-md-6">{{ $order->country }}</div>
            </div>
            <div class="row">
                <div class="col-md-6">City</div>
                <div class="col-md-6">{{ $order->city }}</div>
            </div>
            <div class="row">
                <div class="col-md-6">Address</div>
                <div class="col-md-6">{{ $order->address }}</div>
            </div>
        </div>
        <div class="col-md-8">
            <h4>{{ __('Products') }}</h4>
            <table width="100%">
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                @foreach($order->products as $product)
                    <tr>
                        <td><img src="{{ asset('storage/' . $product->thumbnail) }}" width="75" /></td>
                        <td><strong>{{ $product->title }}</strong></td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->single_price }}</td>
                        <td>{{ $product->pivot->quantity * $product->pivot->single_price }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="right"><strong>Subtotal: {{ $order->total }}</strong></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
