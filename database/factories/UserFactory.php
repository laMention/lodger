<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'reference' => Str::random(8),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'contact' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => Hash::make('1234567890'), // password
            'remember_token' => Str::random(40),
            'type_user' => 1,
            'role' => 0,
            'agence_id' => 1,
            'locataire_id' => 1,
            'status' => 1,
            'etat' => 1,
            'pays_id' => 52,
            'ville' => "Abidjan",

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
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
