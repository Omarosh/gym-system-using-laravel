<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityManger extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'city_name',
        'national_id',
        'image_path'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
