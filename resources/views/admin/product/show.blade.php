@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Product') }}</h3>
                        <div>
                            <a href="{{route('admin.products.index')}}">Back to products</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">ID</div>
                            <div class="col-sm-10">{{ $product->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Title</div>
                            <div class="col-sm-10">{{ $product->title }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Slug</div>
                            <div class="col-sm-10">{{ $product->slug }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Category</div>
                            <div class="col-sm-10">{{ $product->category->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Description</div>
                            <div class="col-sm-10">{{ $product->description }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">SKU</div>
                            <div class="col-sm-10">{{ $product->sku }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Price</div>
                            <div class="col-sm-10">{{ $product->price }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">Discount</div>
                            <div class="col-sm-10">{{ $product->discount }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">In stock</div>
                            <div class="col-sm-10">{{ $product->in_stock }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
