<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
class IncidentFactory extends Factory
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
            'sujet' => "incidence declarée",
            'description' => 'lorem ipsum dolor cate jdoiu gdjkklf',
            'etat' => 1,
            'status' => 1,
            'appartement_id' => 1,
            'user_id' => 1,
            'agence_id' => 1,
        ];
    }
}
