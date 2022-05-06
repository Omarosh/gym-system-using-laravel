<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $attributes = [
        'cover_image_path' => 'default.jpg',
    ];
    use HasFactory;
    protected $fillable = [
        'name',
        'cover_image_path',
        'city_name',
        
        
    ];

    // public function cityManger()
    // {
    //     return $this->belongsTo(CityManger::class);
    // }
}
