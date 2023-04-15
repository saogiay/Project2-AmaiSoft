<?php

namespace App\Jobs;

use App\Mail\OrderInvoice;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Starting SendOrderInvoice job');
        // Lấy thông tin khách hàng từ đơn hàng
        $user = $this->order->user;

        // Gửi email hóa đơn đến khách hàng
        Mail::to($user->email)->send(new OrderInvoice($this->order));
        Log::info('Finished SendOrderInvoice job');
    }
}
