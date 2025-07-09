<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agence>
 */
class AgenceFactory extends Factory
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
            'name' => "LOCAGENCE",
            'email' => "locagence@yopmail.com",
            'contact' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'agrement' => random_int(10000, 99999),
            'code_verification' => random_int(10000, 99999),
            'etat' => 1,
            'pays_id' => 52,
            'ville' => "Abidjan",
        ];
    }
}
