<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'ubicaciones';

    /**
     * Los atributos por default del modelo.
     *
     * @var array
     */
    protected $fillable = [
        'estantes_id',
        'secciones_id',
        'nombre',
        'cantidad',
        'descripcion'
    ];

    /**
     * Obtiene los libros de la seccion
     */
    public function libros()
    {
        return $this->hasMany('App\Libro');
    }

    /**
     * Obtiene el estante al que pertenece
     */
    public function estante()
    {
        return $this->belongsTo('App\Estante');
    }

    /**
     * Obtiene la seccion a la que pertenece
     */
    public function seccion()
    {
        return $this->belongsTo('App\Seccion');
    }
}
