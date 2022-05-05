<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'date_of_birth',
        'email',
        'passwd',
        'training_package_id',
    ];

   public function trainingpackege(){
       return $this->hasOne(Trainingpackege::class);
   }
}
