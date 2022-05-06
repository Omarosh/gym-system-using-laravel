<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymManger extends Model
{
    protected $attributes = [
        'image_path' => 'default.jpg',
    ];
    use HasFactory;
    protected $fillable = [
        'city_name',
        'national_id',
        'gym_id',
        'user_id',
        'image_path'
        
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
