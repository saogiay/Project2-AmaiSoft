<?php

namespace App\Jobs;

use App\Mail\MailVoucher;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVoucherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $voucher, $customerIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($voucher, $customerIds)
    {
        $this->voucher = $voucher;
        $this->customerIds = $customerIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customers = User::whereIn("id", $this->customerIds)->get();
        foreach ($customers as $customer) {
            Mail::to($customer->email)->send(new MailVoucher($this->voucher));
        }
    }
}
