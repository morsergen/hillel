@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>{{ __('Cart') }}</h1>
            </div>
            <div class="col-md-12">
                @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->count() > 0)
                    <table class="table table-light">
                        <thead>
                            @include('cart.chunk.product_header')
                        </thead>
                        <tbody>
                            @each('cart.chunk.product_view', \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content(), 'row')
                        </tbody>
                        <tfoot>
                            @include('cart.chunk.product_subtotal')
                        </tfoot>
                    </table>
                    <div class="text-center">
                        <a href="{{ route('checkout') }}" class="btn btn-outline-success">{{ __('Process to checkout') }}</a>
                    </div>
                @else
                    <h3 class="text-center">{{ __('You cart is empty') }}</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
