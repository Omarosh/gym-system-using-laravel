<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'date_of_birth',
        'email',
        'passwd',
    ];
    use HasFactory;
}
