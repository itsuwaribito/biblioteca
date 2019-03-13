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
    protected $fillable = [
        'fecha_prestamo',
        'fecha_devolucion',
        'observaciones',
        'libros_id',
        'alumnos_id'
    ];

    public function alumno()
    {
        return $this->belongTo('App\Alumno');
    }
}
