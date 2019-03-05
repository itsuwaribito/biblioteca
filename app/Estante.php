<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'estantes';

    /**
     * Los atributos por default del modelo.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    /**
     * Obtiene las secciones del estante.
     */
    public function secciones()
    {
        return $this->belongsToMany('App\Seccion','ubicaciones');
    }
}
