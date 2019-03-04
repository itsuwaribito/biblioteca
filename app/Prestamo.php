<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'prestamos';

    /**
     * Los atributos por default del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'id',
        'fecha_prestamo',
        'fecha_devolucion',
        'observaciones'
    ];

    public function alumno()
    {
        return $this->belongTo('App\Alumno');
    }
}
