<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'gym_id',
        "gym_manger_id",
        
        
    ];
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    
    public function gymManger()
    {
        return $this->belongsTo(GymManger::class);
    }
}
