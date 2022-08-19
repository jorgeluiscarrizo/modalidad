<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Str;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //vendedor1
        Seller::create([
            'name' => 'Miguel Fuentes',
            'ci' => '7165445',
            'cell' => '124564',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //vendedor2
        Seller::create([
            'name' => 'Javier Ramos',
            'ci' => '7165445',
            'cell' => '124564',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //vendedor3
        Seller::create([
            'name' => 'Ronaldo Cardenas',
            'ci' => '7165445',
            'cell' => '124564',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
    }
}
