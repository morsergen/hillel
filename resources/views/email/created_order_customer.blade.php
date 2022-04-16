@component('mail::message')

Уведомление для покупателя

Спасибо за покупку! Ваш ордер с номером <strong>{{ $order->id }}</strong> уже в работе

@component('mail::button', ['url' => route('account.orders.show', compact('order'))])
Button text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
