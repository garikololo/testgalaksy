<?php

namespace App\Console\Commands;

use App\Models\Driver;
use App\Models\Bus;
use App\Jobs\SendRetirementSms;
use App\Jobs\SendRetirementEmail;
use Illuminate\Console\Command;


class CheckDrivers extends Command
{
    protected $signature = 'drivers:check';

    public function handle()
    {
        $drivers = Driver::all();

        foreach ($drivers as $driver) {

            if ($driver->birth_date->age >= 65) {

                // зберігаємо дані перед видаленням
                $busNumbers = $driver->buses->pluck('number')->toArray();

                // відв’язати автобуси
                Bus::where('driver_id', $driver->id)
                    ->update(['driver_id' => null]);

                // видалити водія
                $driver->delete();

                // SMS через 5 хв
                SendRetirementSms::dispatch($driver, $busNumbers)
                    ->delay(now()->addMinutes(5));

                // Email через 15 хв
                SendRetirementEmail::dispatch($driver, $busNumbers)
                    ->delay(now()->addMinutes(15));
            }
        }
    }
}
