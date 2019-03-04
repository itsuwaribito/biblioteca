<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'secciones';

    /**
     * Los atributos por default del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'id',
        'nombre'
    ];
}
