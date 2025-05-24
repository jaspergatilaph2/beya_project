<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = [
        'user_id',
        'appointment_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function appointment()
    {
        return $this->belongsTo(\App\Models\Appointments::class);
    }
    use HasFactory;
}
