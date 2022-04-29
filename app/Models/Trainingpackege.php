<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainingpackege extends Model
{   

    protected $fillable = [
        
        'name',
        'price',
        "num_of_sessions",
        
        
    ];
    use HasFactory;
}
