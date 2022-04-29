<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
    public function session()
    {
        return $this->belongsTo(TrainingSession::class);
    }
}
