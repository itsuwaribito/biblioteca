<?php

use Illuminate\Database\Seeder;

class LibrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Libro::class,1500)->create(['estados_id' => 1]);
    }
}
