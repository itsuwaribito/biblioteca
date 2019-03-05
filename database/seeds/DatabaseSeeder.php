<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(AlumnosTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(SeccionesTableSeeder::class);
        $this->call(EstantesTableSeeder::class);
        $this->call(UbicacionesTableSeeder::class);
        $this->call(LibrosTableSeeder::class);
    }
}
