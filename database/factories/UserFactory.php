<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'mobile' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'role' => 'admin', // Default role is 'admin'
            'status' => $this->faker->randomElement([1]), // Random status (0 or 1)
            'photo' => 'default.jpg', // Default profile photo filename
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password (you can change this)
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
