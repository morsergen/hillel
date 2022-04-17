@component('mail::message')

Уведомление для админа

В магазине новый ордер {{ $order->id }}

@component('mail::button', ['url' => route('admin.orders.edit', compact('order'))])
Show order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
