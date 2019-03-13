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
    protected $fillable = [
        'titulo',
        'autor',
        'editorial',
        'edicion',
        'publicacion',
        'adquisicion',
        'observaciones',
        'cantidad',
        'imagen',
        'estados_id',
        'ubicaciones_id'
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
        return $this->hasMany('App\Prestamo', 'libros_id');
    }

    /**
     * Obtiene los alumnos que aun no regresan el libro
     */
    public function alumnosPendientes()
    {
        return $this->belongsToMany('App\Alumno', 'prestamos', 'libros_id', 'alumnos_id')
        ->wherePivot('fecha_devolucion',NULL)
        ->withPivot([
            'fecha_prestamo',
            'fecha_devolucion',
            'observaciones'
        ]);
    }
    
    /**
     * Obtiene los alumnos que devolbieron el libro
     */
    public function alumnosNoPendientes()
    {
        return $this->belongsToMany('App\Alumno', 'prestamos', 'libros_id', 'alumnos_id')
        ->where('fecha_devolucion','<',\Carbon\Carbon::now())
        ->withPivot([
            'fecha_prestamo',
            'fecha_devolucion',
            'observaciones'
        ]);
    }
}
