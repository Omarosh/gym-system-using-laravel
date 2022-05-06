<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPackege extends Model
{   
    protected $table = 'training_packages';
    
    protected $fillable = [
        'name',
        'price',
        "num_of_sessions", 
    ];
    use HasFactory;
}
