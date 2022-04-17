@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>{{ __('Orders') }}</h1>
                <table width="100%">
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>User email</th>
                        <th>Created</th>
                        <th>Total price</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->status->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->total }}</td>
                            <td class="actions">
                                <a href="{{route('admin.orders.edit', ['order'=> $order])}}"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="div_paginate"><?php echo e($orders->links('admin/pagination/default')); ?></div>
            </div>
        </div>
    </div>
@endsection
