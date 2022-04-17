<?php

namespace App\Jobs;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrderCancelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Order $order)
    {
        $this->queue = 'order_cancel';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(OrderRepositoryInterface $orderRepository)
    {
        $orderRepository->cancel($this->order);
    }
}
