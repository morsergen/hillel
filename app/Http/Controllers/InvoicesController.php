<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Contracts\InvoicesServiceInterface;
use Exception;
use Illuminate\Http\Response;

class InvoicesController extends Controller
{
    /**
     * @param Order $order
     * @param InvoicesServiceInterface $invoicesService
     * @return Response
     * @throws Exception
     */
    public function download(Order $order, InvoicesServiceInterface $invoicesService): Response
    {
        return $invoicesService->generate($order)->download();
    }
}
