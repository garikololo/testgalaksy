<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendRetirementSms implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(
        public $driver,
        public $buses
    ) {}

    public function handle(): void
    {
        $phone = env('ADMIN_PHONE');

        $message = "Водій {$this->driver->first_name} вийшов на пенсію.";

        // тут твій SMS API (Twilio / SMS provider)
        // Http::post(...)
    }
}
