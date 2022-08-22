<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(GoalSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(BatchSeeder::class);
        
    }
}
