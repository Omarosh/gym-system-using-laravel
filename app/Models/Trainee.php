<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
 
use App\Models\TrainingPackage;

class Trainee extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory;
    public $timestamps = false;
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable =[
        'name',
        'gender',
        'date_of_birth',
        'imag_path',
        'email',
        'passwd',
        // 'training_package_id',
    ];


    public function trainingpackage()
    {
        return $this->hasOne(TrainingPackage::class);
    }
}
