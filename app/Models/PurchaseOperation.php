<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOperation extends Model
{
    use HasFactory;


    protected $fillable = [
        'trainee_id',
        'package_id',
        'gym_id',
        'created_by_id',
        'price'
    ];
    // $table->foreignId("trainee_id")->references("id")->on("trainees");
    //         $table->foreignId("package_id")->references("id")->on("training_packages");
    //         $table->foreignId("gym_id")->references("id")->on("gyms");
    //         $table->foreignId("created_by_id")->references("id")->on("users");

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    public function training_package()
    {
        return $this->belongsTo(Trainingpackege::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
