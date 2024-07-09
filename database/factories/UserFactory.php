<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;
    public function definition(): array
    {
        return [
            'profile_image' => $this->faker->imageUrl(), // Generates a URL for a random image
            'name' => $this->faker->name(), // Generates a random name
            'education_informations' => $this->faker->sentence(), // Generates a random sentence for education information
            'qualification' => $this->faker->word(), // Generates a random word for qualification
            'specialist' => $this->faker->jobTitle(), // Generates a random job title
            'whenyouseat' => $this->faker->time(), // Generates a random time
            'seating_day' => $this->faker->dayOfWeek(), // Generates a random day of the week
            'friday_seating_time' => $this->faker->time(), // Generates a random time for Friday seating
            'visit_fee' => $this->faker->randomFloat(2, 20, 200), // Generates a random visit fee between 20 and 200
            'phone' => $this->faker->phoneNumber(), // Generates a random phone number
            'birthday' => $this->faker->date(), // Generates a random date for birthday
            'address' => $this->faker->address(), // Generates a random address
            'gender' => $this->faker->randomElement(['male', 'female']), // Generates a random gender
            'role' => 'user', // Sets the role to 'user'
            'email' => $this->faker->unique()->safeEmail(), // Generates a unique safe email
            'email_verified_at' => now(), // Sets the current timestamp
            'password' => Hash::make('password'), // Hashes the password 'password'
            'status' => '0', // Sets the default status to '0'
            'remember_token' => Str::random(10), // Generates a random remember token

        ];
    }
}
