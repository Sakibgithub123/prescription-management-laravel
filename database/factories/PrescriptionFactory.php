<?php

namespace Database\Factories;

use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Prescription::class;
    public function definition(): array
    {
        $user = User::all()->random();
        return [
            // 'dr_id' => $user->id, // Fetches a random user ID from the users table
            // 'patient_name' => $this->faker->name(), // Generates a random patient name
            // 'patient_age' => $this->faker->numberBetween(1, 100), // Generates a random age between 1 and 100
            // 'visit_fee' => $user->visit_fee, // Generates a random visit fee between 20 and 200
            // 'reg_no' => $this->faker->unique()->numerify('REG#####'), // Generates a unique registration number
            // 'date' => $this->faker->date(), // Generates a random date
            // 'complaints' => implode(' ', $this->faker->sentences($nb = 2)),
            // 'tests' => implode(' ', $this->faker->words($nb = 3)),
            // 'investigations' => implode(' ', $this->faker->words($nb = 2)),
            // 'medicine' => implode(' ', $this->faker->words($nb = 2)),
            // 'howmanytimes' => implode(',', $this->faker->randomElements(['1+1+1', '1+0+1', '1+0+0', '0+1+1'], $count = 2)),
            // 'afterbefore' => implode(',', $this->faker->randomElements(['after', 'before'], $count = 2)),
            'dr_id' => $user->id,
            'patient_name' => $this->faker->name(),
            'patient_age' => $this->faker->numberBetween(1, 100),
            'visit_fee' => $user->visit_fee,
            'reg_no' => $this->faker->unique()->numerify('REG#####'),
            'date' => $this->faker->date(),
            'complaints' => json_encode($this->faker->sentences($nb = 2)),
            'tests' => json_encode($this->faker->words($nb = 3)),
            'investigations' => json_encode($this->faker->words($nb = 2)),
            'medicine' => json_encode($this->faker->words($nb = 2)),
            'howmanytimes' => json_encode($this->faker->randomElement(['1+1+1', '1+0+1', '1+0+0', '0+1+1'], $count = 2)),
            'afterbefore' => json_encode($this->faker->randomElement(['after', 'before'], $count = 2)),

            'nextdate' => json_encode([
                $this->faker->numberBetween(1, 30),
                $this->faker->numberBetween(1, 30),
                $this->faker->numberBetween(1, 30)
            ]), // Generates an array of 3 random dates for next appointment


        ];
    }
}
