<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;

class LibrosController extends Controller
{
    public function store(Request $request)
    {
        $formData = $request->all();
        $formData['estados_id'] = 1;
        $dato = Libro::create($formData);
        return $dato;
    }

    public function update(Request $request, $id)
    {
        $libro = Libro::find($id);
        $libro->adquisicion = $request->adquisicion;
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->edicion = $request->edicion;
        $libro->cantidad = $request->cantidad;
        $libro->editorial = $request->editorial;
        $libro->publicacion = $request->publicacion;
        $libro->observaciones = $request->observaciones;
        $libro->ubicaciones_id = $request->ubicaciones_id;
        $libro->save();

        return $libro;
    }
}
