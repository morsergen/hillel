@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>{{ __('Order #') . $order->id }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">Status</div>
                        <div class="col-sm-8">{{ $order->status->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">User Name</div>
                        <div class="col-sm-8">{{ $order->name }} {{ $order->surname }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">User email</div>
                        <div class="col-sm-8">{{ $order->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Phone</div>
                        <div class="col-sm-8">{{ $order->phone }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"><h3>Billing data</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Country</div>
                        <div class="col-sm-8">{{ $order->country }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">City</div>
                        <div class="col-sm-8">{{ $order->city }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Address</div>
                        <div class="col-sm-8">{{ $order->address }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h3>Order items</h3>
                <table width="100%">
                    <tr>
                        <th>№</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                    </tr>
                @foreach($order->products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <p><img src="{{ asset('storage/' . $product->thumbnail) }}" width="75" /></p>
                        </td>
                        <td>
                            <p>
                                <a href="{{ route('products.show', $product) }}">
                                    <strong>{{ $product->title }}</strong>
                                </a>
                            </p>
                        </td>
                        <td>{{ $product->pivot->single_price }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->single_price * $product->pivot->quantity }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="6" class="text-right">Total: {{ $order->total }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @if(!$order->is_canceled && !$order->is_completed)
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('account.orders.cancel', ['order' => $order]) }}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="{{ __('Cancel order') }}">
                </form>
            </div>
        </div>
        @endif
    </div>
@endsection
