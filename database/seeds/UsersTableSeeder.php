<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jairo',
            'username' => 'jnava',
            'apellido_paterno' => 'Nava',
            'apellido_materno' => 'Magaña',
            'email' => 'jnava@unidep.com',
            'password' => '123',
        ]);
    }
}
