<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeVehicle;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'license_plate' => Str::random(6),
            'type_vehicle_id'=> TypeVehicle::inRandomOrder()->first()->id,
            'status' => $this->faker->boolean,
        ];
    }
}
