<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner()
{
    return $this->belongsTo(User::class, 'user_id'); // or 'user_id', depending on your DB
}
    protected $fillable = [
        'user_id',
        'owner_name',
        'pet_name',
        'contact_number',
        'pet_breed',
        'appointment_date',
        'status',
        'upload_document',
        'pets_picture',
        'reason',

    ];

    protected $dates = ['appointment_date'];
    // or in newer Laravel versions
    protected $casts = [
        'appointment_date' => 'date',
    ];
    protected $table = 'appointments';
    use HasFactory;
}
