@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Edit order') }}</h3>
                        <div>
                            <a href="{{route('admin.orders.index')}}">Back to orders</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.orders.update', ['order' => $order]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="status_id" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                    <select id="status_id" name="status_id" class="form-control @error('status_id') is-invalid @enderror" required>
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}" @if($order->status_id == $status->id) selected @endif >{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12"><h3>User data</h3></div>
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

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update order') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
