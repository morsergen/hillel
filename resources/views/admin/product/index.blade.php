@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Products') }} ({{$products->count()}})</h3>
                        <div>
                            <a href="{{route('admin.products.create')}}">Create new</a>
                        </div>
                    </div>
                    <table class="admin">
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>In stock</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ asset('storage/' . $product->thumbnail) }}" width="50" /></td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ $product->in_stock }}</td>
                                <td class="actions">
                                    <a href="{{route('admin.products.show', ['product'=> $product])}}"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('admin.products.edit', ['product'=> $product])}}"><i class="fa fa-edit"></i></a>

                                    <a href="javascript:void(0);" onclick="document.getElementById('delete-form-{{$product->id}}').submit();">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form id="delete-form-{{$product->id}}" method="POST" style="display: none;"
                                          action="{{route('admin.products.destroy', ['product'=> $product])}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="div_paginate">{{ $products->links('admin/pagination/default') }}</div>
            </div>
        </div>
    </div>
@endsection
