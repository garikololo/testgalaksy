<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDriverRemoveEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function handle(): void
    {
        Mail::raw(
            "Дякуємо {$this->driver->first_name} що працювали в нас. З повагою АТП",
            function ($message) {
                $message->to($this->driver->email)
                    ->subject('Прощальний лист');
            }
        );
    }
}