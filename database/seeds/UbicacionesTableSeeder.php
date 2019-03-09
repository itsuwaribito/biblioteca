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
                'secciones_id' => 1,
                'nombre' => 'Seccion 1 - Estante 1'
            ],
            [
                'estantes_id' => 1,
                'secciones_id' => 2,
                'nombre' => 'Seccion 2 - Estante 1'
            ],
            [
                'estantes_id' => 2,
                'secciones_id' => 1,
                'nombre' => 'Seccion 1 - Estante 2'
            ],
            [
                'estantes_id' => 2,
                'secciones_id' => 2,
                'nombre' => 'Seccion 2 - Estante 2'
            ],
            [
                'estantes_id' => 3,
                'secciones_id' => 1,
                'nombre' => 'Seccion 1 - Estante 3'
            ],
            [
                'estantes_id' => 3,
                'secciones_id' => 2,
                'nombre' => 'Seccion 2 - Estante 3'
            ],
            [
                'estantes_id' => 4,
                'secciones_id' => 1,
                'nombre' => 'Seccion 1 - Estante 4'
            ],
            [
                'estantes_id' => 4,
                'secciones_id' => 2,
                'nombre' => 'Seccion 2 - Estante 4'
            ],
            [
                'estantes_id' => 5,
                'secciones_id' => 1,
                'nombre' => 'Seccion 1 - Estante 5'
            ],
            [
                'estantes_id' => 5,
                'secciones_id' => 2,
                'nombre' => 'Seccion 2 - Estante 5'
            ],
            [
                'estantes_id' => 6,
                'secciones_id' => 1,
                'nombre' => 'Seccion 1 - Estante 6'
            ],
            [
                'estantes_id' => 6,
                'secciones_id' => 2,
                'nombre' => 'Seccion 2 - Estante 6'
            ],
            [
                'estantes_id' => 7,
                'secciones_id' => 1,
                'nombre' => 'Seccion 1 - Estante 7'
            ],
            [
                'estantes_id' => 7,
                'secciones_id' => 2,
                'nombre' => 'Seccion 2 - Estante 7'
            ]
        ];

        foreach ($data as $value) {
            factory(App\Ubicacion::class)->create($value);
        }
    }
}
