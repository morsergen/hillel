<?php

namespace App\Services\Contracts;

interface PayPalServiceInterface
{
    public function getDataForCreateOrder(float $total);
}
