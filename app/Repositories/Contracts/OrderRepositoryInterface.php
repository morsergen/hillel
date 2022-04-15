<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function create(array $requestData): Order;
    public function cancel(Order $order);
}
