<?php

use Illuminate\Database\Seeder;

class SeccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nombre' => 'Seccion 1'
            ],
            [
                'nombre' => 'Seccion 2'
            ]
        ];

        foreach ($data as $value) {
            App\Seccion::create($value);
        }
    }
}
