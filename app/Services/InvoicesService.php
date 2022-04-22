<?php

namespace App\Services;

use App\Models\Order;
use App\Services\Contracts\InvoicesServiceInterface;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Facades\Invoice as InvoiceFacade;

class InvoicesService implements InvoicesServiceInterface
{
    public function generate(Order $order): Invoice
    {
        $customer = $this->getBuyer($order);

        $items = $this->getItems($order);

        return $this->createInvoice($order, $customer, $items);
    }

    /**
     * @param Order $order
     * @return Buyer
     */
    public function getBuyer(Order $order): Buyer
    {
        return new Buyer([
            'name' => $order->name . ' ' . $order->surname,
            'custom_fields' => [
                'email' => $order->email,
                'phone' => $order->phone,
                'country' => $order->country,
                'city' => $order->city,
                'address' => $order->address,
            ]
        ]);
    }

    /**
     * @param Order $order
     * @return array
     */
    public function getItems(Order $order): array
    {
        $items = [];

        foreach ($order->products as $product) {
            $items[] = (new InvoiceItem())
                ->title($product->title)
                ->pricePerUnit($product->pivot->single_price)
                ->quantity($product->pivot->quantity)
                ->units('шт');
        }

        return $items;
    }

    /**
     * @param Order $order
     * @param Buyer $customer
     * @param array $items
     * @return mixed
     */
    public function createInvoice(Order $order, Buyer $customer, array $items): mixed
    {
        $invoice = InvoiceFacade::make()
            ->status($order->status->name)
            ->serialNumberFormat($order->id)
            ->buyer($customer)
            ->taxRate(config('cart.tax'))
            ->filename('Invoice_' . time() . '_' . $order->user->id . '_' . $order->id)
            ->logo('https://itc.ua/wp-content/uploads/2022/03/rozetka.png')
            ->addItems($items);

        if ($order->is_progress) {
            $invoice->payUntilDays(7);
        }

        return $invoice;
    }
}
