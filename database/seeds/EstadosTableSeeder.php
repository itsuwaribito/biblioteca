<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
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
                'nombre' => 'En existencia'
            ],
            [
                'nombre' => 'Agotado'
            ]
        ];

        foreach ($data as $value) {
            App\Estado::create($value);
        }
    }
}
