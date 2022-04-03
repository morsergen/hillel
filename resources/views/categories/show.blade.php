@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p><img src="{{ asset('storage/' . $category->thumbnail) }}" width="100%" /></p>
        </div>
        <div class="col-md-6">
            <h1>{{ $category->name }}</h1>
            <h3>{{ $category->description }}</h3>
        </div>
    </div>

    <hr>

    <div class="row">
        @empty($products->total())
            <h2>В данной категории пока нет ни одного продукта</h2>
        @else
            @each('products.chunk.product_categories', $products, 'product')
        @endempty
    </div>

    <div class="row">
        <div class="div_paginate">{{ $products->links('admin/pagination/default') }}</div>
    </div>
</div>
@endsection
