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
       
        
        
    ];
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    
   
}
