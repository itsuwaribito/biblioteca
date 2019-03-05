<?php

use Illuminate\Database\Seeder;

class UbicacionesTableSeeder extends Seeder
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
                'estantes_id' => 1,
                'secciones_id' => 1
            ],
            [
                'estantes_id' => 1,
                'secciones_id' => 2
            ],
            [
                'estantes_id' => 2,
                'secciones_id' => 1
            ],
            [
                'estantes_id' => 2,
                'secciones_id' => 2
            ],
            [
                'estantes_id' => 3,
                'secciones_id' => 1
            ],
            [
                'estantes_id' => 3,
                'secciones_id' => 2
            ],
            [
                'estantes_id' => 4,
                'secciones_id' => 1
            ],
            [
                'estantes_id' => 4,
                'secciones_id' => 2
            ],
            [
                'estantes_id' => 5,
                'secciones_id' => 1
            ],
            [
                'estantes_id' => 5,
                'secciones_id' => 2
            ],
            [
                'estantes_id' => 6,
                'secciones_id' => 1
            ],
            [
                'estantes_id' => 6,
                'secciones_id' => 2
            ],
            [
                'estantes_id' => 7,
                'secciones_id' => 1
            ],
            [
                'estantes_id' => 7,
                'secciones_id' => 2
            ]
        ];

        foreach ($data as $value) {
            factory(App\Ubicacion::class)->create($value);
        }
    }
}
