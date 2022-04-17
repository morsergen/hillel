@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>{{ __('Account') . ' ' . auth()->user()->full_name }}</h1>
            </div>
            <div class="col-md-12">
                @empty(auth()->user()->telegram_id)
                    <script async src="https://telegram.org/js/telegram-widget.js?19"
                            data-telegram-login="{{ config('services.telegram-bot-api.name') }}"
                            data-size="small"
                            data-auth-url="{{ route('account.telegram.callback') }}"
                            data-request-access="write">
                    </script>
                @endempty
            </div>
            <div class="col-md-12">
                <div>ID: {{ auth()->user()->id }}</div>
                <div>Role: {{ auth()->user()->role->name }}</div>
                <div>Balance: {{ auth()->user()->balance }}</div>
                <div>Name: {{ auth()->user()->name }}</div>
                <div>Surname: {{ auth()->user()->surname }}</div>
                <div>Email: {{ auth()->user()->email }}</div>
                <div>Birthdate: {{ auth()->user()->birthdate }}</div>
                <div>Phone: {{ auth()->user()->phone }}</div>
                <div>Register date: {{ auth()->user()->created_at }}</div>
            </div>
        </div>
    </div>
@endsection
