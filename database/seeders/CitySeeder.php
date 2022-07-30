<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        City::create([
            'name' => 'Tarija',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //2
        City::create([
            'name' => 'Yacuíba',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //3
        City::create([
            'name' => 'Bermejo',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //4
        City::create([
            'name' => 'Entre Rios',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //5
        City::create([
            'name' => 'Padcaya',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //6
        City::create([
            'name' => 'Villa Montes',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //7
        City::create([
            'name' => 'Uriondo',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //8
        City::create([
            'name' => 'El Puente',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //9
        City::create([
            'name' => 'San Lorenzo',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //10
        City::create([
            'name' => 'Caraparí',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //11
        City::create([
            'name' => 'Yunchara',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
    }
}
