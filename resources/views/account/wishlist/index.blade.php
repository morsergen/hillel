@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>{{ __('Wish List') }}</h1>
            </div>
            <div class="col-md-12">
                @each('products.chunk.product_categories', auth()->user()->wishes, 'product')
            </div>
        </div>
    </div>
@endsection
