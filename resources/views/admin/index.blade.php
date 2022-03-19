@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>
                    <div class="card-body">
                        {{ __('Hello, admin!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
