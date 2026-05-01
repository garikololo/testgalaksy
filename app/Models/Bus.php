<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'brand_id'];
    protected $table = 'buses';

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = mb_strtoupper($value);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'drivers_to_buses');
    }
}
