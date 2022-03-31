@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $product->title }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><img src="{{ asset('storage/' . $product->thumbnail) }}" width="100%" /></p>
        </div>
        <div class="col-md-6">
            <h1>
                {{ $product->end_price }}
                @if($product->discount)
                    (скидка {{ $product->discount }}%)
                @endif
            </h1>
            <hr>
            <h4>
                <input type="number" value="1" min="1" max="{{ $product->in_stock }}" />
                <button type="button" class="btn btn-success">добавить в корзину</button>
            </h4>
            <hr>
            <p>Категория:
                <strong>
                    <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                </strong>
            </p>
            <p>SKU: <strong>{{ $product->sku }}</strong></p>
            <p>В наличии: <strong>{{ $product->in_stock }}</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>{{ $product->description }}</h3>
        </div>
    </div>
</div>
@endsection
