<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRetirementEmail implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(
        public $driver,
        public $buses
    ) {}

    public function handle(): void
    {
        $email = env('ADMIN_EMAIL');

        $busNumbers = implode(',', $this->buses);

        Mail::raw(
            "Водій {$this->driver->first_name} вийшов на пенсію. Автобуси: {$busNumbers} залишились без водія.",
            function ($message) use ($email) {
                $message->to($email)
                    ->subject('Пенсія водія');
            }
        );
    }
}