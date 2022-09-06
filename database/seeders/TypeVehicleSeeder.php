<?php

namespace Database\Seeders;
use  App\Models\TypeVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeVehicle = new TypeVehicle();
        $typeVehicle->name = 'No resident';
        $typeVehicle->description = 'Vehicle that does not belong to the area.';
        $typeVehicle->save();

        $typeVehicle = new TypeVehicle();
        $typeVehicle->name = 'Resident';
        $typeVehicle->description = 'Vehicle belonging to a resident of the area.';
        $typeVehicle->save();

        $typeVehicle = new TypeVehicle();
        $typeVehicle->name = 'Official';
        $typeVehicle->description = 'Vehicle belonging to a Official';
        $typeVehicle->save();
    }
}
