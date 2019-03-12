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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * Obtiene el nombre completo como un solo campo
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['nombre'].' '.$this->attributes['apellido_paterno'].' '.$this->attributes['apellido_materno'];
    }

    /**
     * Obtiene los libros del alumno.
     */
    public function libros()
    {
        return $this->belongsToMany('App\Libro', 'prestamos', 'alumnos_id', 'libros_id');
    }

    /**
     * Obtiene los libros que el alumno aun no regresa.
     */
    public function librosPrestados()
    {
        return $this->belongsToMany('App\Libro', 'prestamos', 'alumnos_id', 'libros_id')
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
        return $this->belongsToMany('App\Libro', 'prestamos', 'alumnos_id', 'libros_id')
        ->where('fecha_devolucion','<',\Carbon\Carbon::now())
        ->withPivot([
            'fecha_prestamo',
            'fecha_devolucion',
            'observaciones'
        ]);
    }
}
