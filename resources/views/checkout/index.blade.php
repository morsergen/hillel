@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>{{ __('Checkout') }}</h1>
            </div>
        </div>
        <hr>
        @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->count() > 0)
            <form action="{{ route('order.create') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @include('checkout.chunk.checkout_user_edit')
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 text-center">
                            <h3>{{ __('Order data') }}</h3>
                        </div>
                        <table class="table table-light">
                            <thead>
                                @include('checkout.chunk.checkout_header')
                            </thead>
                            <tbody>
                                @each('checkout.chunk.checkout_product_view', \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content(), 'row')
                            </tbody>
                            <tfoot>
                                @include('checkout.chunk.checkout_subtotal')
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="{{ __('Pay') }}">
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
