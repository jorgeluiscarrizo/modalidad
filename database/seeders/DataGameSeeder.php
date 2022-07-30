<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Map;
use App\Models\User;
use Illuminate\Database\Seeder;

class DataGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Registrando mapas

        Map::create([
            'name' => 'Llanos bolivianos',
            'description' => 'Llanos bolivianos (Oriente).',
            'slug' => 'llanos-bolivianos',
            'state' => 'ACTIVE'
        ]);

        Map::create([
            'name' => 'Andes boliviano',
            'description' => 'Andes boliviano (Occidente).',
            'slug' => 'andes-boliviano',
            'state' => 'ACTIVE'
        ]);

        Map::create([
            'name' => 'Subandes boliviano',
            'description' => 'Subandes boliviano.',
            'slug' => 'subandes-boliviano',
            'state' => 'ACTIVE'
        ]);


       
    }
}
