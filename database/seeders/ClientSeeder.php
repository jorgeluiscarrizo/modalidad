<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cliente1
        Client::create([
            'id_type' => 1,
            'name' => 'Pedro Barrera',
            'num_cell' => '789-3264',
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //cliente12
        Client::create([
            'id_type' => 2,
            'name' => 'Carlos Jurado',
            'num_cell' => '789-3264',
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //cliente3
        Client::create([
            'id_type' => 3,
            'name' => 'Ramon Velasquez',
            'num_cell' => '789-3264',
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
    }
}
