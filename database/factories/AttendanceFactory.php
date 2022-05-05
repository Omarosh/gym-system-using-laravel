<?php

namespace Database\Factories;

use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trainee_id' => 1,
            'training_session_id' => 1,
        ];
    }
}
