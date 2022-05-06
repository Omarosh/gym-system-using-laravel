<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        "num_of_sessions",
    ];
  
}
