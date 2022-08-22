<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Batch;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //lote1
        Batch::create([
            'product_id' => 1,
            'name' => 'Triple acción',
            'price' => '7',
            'stock' => '78',
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //lote2
        Batch::create([
            'product_id' => 2,
            'name' => 'Kolyno',
            'price' => '5',
            'stock' => '52',
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //lote3
        Batch::create([
            'product_id' => 3,
            'name' => 'Cepillo 360',
            'price' => '15',
            'stock' => '63',
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
        //lote4
        Batch::create([
            'product_id' => 4,
            'name' => 'Enjuague sof mint',
            'price' => '25',
            'stock' => '40',
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => 'ACTIVE',
        ]);
    }
}
