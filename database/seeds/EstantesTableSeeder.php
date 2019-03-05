<?php

use Illuminate\Database\Seeder;

class EstantesTableSeeder extends Seeder
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
                'nombre' => 'Estante A'
            ],
            [
                'nombre' => 'Estante B'
            ],
            [
                'nombre' => 'Estante C'
            ],
            [
                'nombre' => 'Estante D'
            ],
            [
                'nombre' => 'Estante E'
            ],
            [
                'nombre' => 'Estante F'
            ],
            [
                'nombre' => 'Estante G'
            ]
        ];

        foreach ($data as $value) {
            App\Estante::create($value);
        }
    }
}
