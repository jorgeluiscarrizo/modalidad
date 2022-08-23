<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //producto1
        Product::create([
            'name' => 'Triple acción',
            'description' => 'Pasta mentolada',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //producto2
        Product::create([
            'name' => 'Kolyno',
            'description' => 'Pasta blanca',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //producto3
        Product::create([
            'name' => 'Cepillo 360',
            'description' => '',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //producto4
        Product::create([
            'name' => 'Enjuague sof mint',
            'description' => 'sabor a menta',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //producto5
        Product::create([
            'name' => 'DEO Speed Stick',
            'description' => 'proteccion 24hrs',
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
    }
}
