<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rol_admin = new Role();
        $rol_admin->name = 'admin';
        $rol_admin->description = 'Administrator';
        $rol_admin->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();


        //Users
        $Admin = User::create([
            'name' => 'Jorge',
            'email' => 'jc12carrizo@gmail.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);
        $Admin->roles()->attach($rol_admin);

        $User = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'state' => 'ACTIVE',
            'email_verified_at' => now(),
            'password' => bcrypt('user'),
            'remember_token' => Str::random(10),

        ]);
        $User->roles()->attach($role);


    }
}
