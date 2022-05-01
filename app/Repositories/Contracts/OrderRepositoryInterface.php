<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use App\Models\Transaction;

interface OrderRepositoryInterface
{
    public function create(array $requestData): Order;
    public function cancel(Order $order);
    public function checkResult(array $result);
}
