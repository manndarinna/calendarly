<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pro_id = Role::where('role_name', 'pro')->first()->id;
        $normal_id = Role::where('role_name', 'normal')->first()->id;

        User::create([
            'name' => 'Mika Milosevic',
            'email' => 'mikamilosevic@gmail.com',
            'password' => bcrypt('mikamilosevic'),
            'role_id' => $pro_id
        ]);
        User::create([
            'name' => 'Petar Petrovic Njegos',
            'email' => 'petarpetrovicnjegos@gmail.com',
            'password' => bcrypt('petarpetrovicnjegos'),
            'role_id' => $normal_id
        ]);
        User::create([
            'name' => 'Laza Lazarevic',
            'email' => 'lazalazarevic@gmail.com',
            'password' => bcrypt('lazalazarevic'),
            'role_id' => $normal_id
        ]);
    }
}
