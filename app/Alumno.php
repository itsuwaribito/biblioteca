<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'alumnos';

    /**
     * Los atributos por default del modelo.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'numero_control'
    ];

    /**
     * Obtiene los libros del alumno.
     */
    public function libros()
    {
        return $this->belongsToMany('App\Libro', 'prestamos');
    }

    /**
     * Obtiene los libros que el alumno aun no regresa.
     */
    public function librosPrestados()
    {
        return $this->belongsToMany('App\Libro', 'prestamos')
        ->wherePivot('fecha_devolucion',NULL)
        ->withPivot([
            'fecha_prestamo',
            'fecha_devolucion',
            'observaciones'
        ]);
    }

    /**
     * Obtiene los libros que el alumno regresó.
     */
    public function librosDebueltos()
    {
        return $this->belongsToMany('App\Libro', 'prestamos')
        ->wherePivot('fecha_devolucion','<',\Carbon\Carbon::now())
        ->withPivot([
            'fecha_prestamo',
            'fecha_devolucion',
            'observaciones'
        ]);
    }
}
