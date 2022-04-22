<?php

namespace App\Services\Contracts;

use App\Models\Order;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Invoice;

interface InvoicesServiceInterface
{
    /**
     * @param Order $order
     * @return Invoice
     */
    public function generate(Order $order): Invoice;

    /**
     * @param Order $order
     * @return Buyer
     */
    public function getBuyer(Order $order): Buyer;

    /**
     * @param Order $order
     * @return array
     */
    public function getItems(Order $order): array;

    /**
     * @param Order $order
     * @param Buyer $customer
     * @param array $items
     * @return mixed
     */
    public function createInvoice(Order $order, Buyer $customer, array $items): mixed;
}
