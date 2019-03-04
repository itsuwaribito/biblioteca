<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'libros';

    /**
     * Los atributos por default del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'id',
        'titulo',
        'autor',
        'editorial',
        'edicion',
        'publicacion',
        'adquisicion',
        'observaciones'
    ];

    /**
     * Obtiene el estado al que pertenece
     */
    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

    /**
     * Obtiene la ubicacion donde se encuentra
     */
    public function ubicacion()
    {
        return $this->belongsTo('App\Ubicacion');
    }

    /**
     * Obtiene todos los prestamos
     */
    public function prestamos()
    {
        return $this->hasMany('App\Prestamo');
    }
}
