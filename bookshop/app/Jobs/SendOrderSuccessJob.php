<?php

namespace App\Jobs;

use App\Mail\SendOrderSuccessMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendOrderSuccessJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    public $user;
    public $order;
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // dd(1);
        if ($this->order) {
            $orderItems = $this->order->orderItems;
            \Log::info($orderItems);
            // dd($this->user->email);
            Mail::to($this->user->email)->send(
                new SendOrderSuccessMail($this->user, $this->order, $orderItems)
            );
            // Mail::to($this->user->email)->queue(new SendOrderSuccessMail($this->user, $this->order, $orderItems));
        }
    }
}
