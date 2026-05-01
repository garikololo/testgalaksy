<?php

namespace App\Console\Commands;

use App\Models\Driver;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendSalaryToDrivers extends Command
{
    protected $signature = 'drivers:send-salary';
    protected $description = 'Send salary email to all drivers';

    public function handle(): void
    {
        $nextMonth = Carbon::now()->addMonth()->translatedFormat('F');

        $drivers = Driver::all();

        foreach ($drivers as $driver) {

            $salary = $driver->salary;

            Mail::raw(
                "Ваша поточна зарплата становить {$salary} грн, не забудьте отримати її 1-го {$nextMonth}",
                function ($message) use ($driver) {
                    $message->to($driver->email)
                        ->subject('Зарплата водія');
                }
            );
        }

        $this->info('Salary emails sent successfully.');
    }
}