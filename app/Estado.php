<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'estados';

    /**
     * Los atributos por default del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'id',
        'nombre',
    ];

    /**
     * Obtiene los libros de la seccion
     */
    public function libros()
    {
        return $this->hasMany('App\Libro');
    }
}
