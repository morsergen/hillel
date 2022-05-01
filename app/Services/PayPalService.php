<?php

namespace App\Services;

use App\Services\Contracts\PayPalServiceInterface;

class PayPalService implements PayPalServiceInterface
{
    public function getDataForCreateOrder(float $total)
    {
        return [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $total
                    ]
                ]
            ]
        ];
    }
}
