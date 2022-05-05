<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name',
        'starts_at',
        'finishes_at',
        'gym_id',
        "coach_id",
    ];
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
}
