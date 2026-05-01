<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'birth_date', 'email', 'salary', 'image', 'deleted_at'];


    protected $casts = [
        'birth_date' => 'date',
        'image' => 'array',
    ];

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = mb_strtolower($value);
    }

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getBirthDateAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    public function buses()
    {
        return $this->belongsToMany(Bus::class, 'drivers_to_buses');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function busesUser()
    {
        return $this->belongsToMany(Bus::class, 'drivers_to_buses');
    }
}
