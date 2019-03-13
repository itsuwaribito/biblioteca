<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\Prestamo;

class LibrosController extends Controller
{
    public function store(Request $request)
    {
        $formData = $request->all();
        $formData['estados_id'] = 1;
        $formData['existencia'] = $request->cantidad;
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

    public function prestamo(Request $request, $id)
    {
        $libro = Libro::find($id);

        \DB::transaction(function () use ($id, $libro, $request) {
            $existencia = intval($libro->existencia) - count($request->alumnos);
            if($existencia < 0)
            {
                abort( 500);
            }
            $libro->existencia = $existencia;
            $libro->save();
            
            foreach ($request->alumnos as $alumno) {
                Prestamo::create([
                    'fecha_prestamo' => \Carbon\Carbon::now(),
                    'libros_id' => $id,
                    'alumnos_id' => $alumno,
                    'observaciones' => $request->observaciones
                ]);
            }
        });

        return $libro;
    }

    public function devolucion(Request $request, $id)
    {
        $libro = Libro::find($id);
        
        \DB::transaction(function () use ($id, $libro, $request) {
            Prestamo::where('libros_id', $id)
            ->whereIn('alumnos_id',$request->alumnos)
            ->update(['fecha_devolucion' => \Carbon\Carbon::now()]);
            
            $libro->existencia = intval($libro->existencia) + count($request->alumnos);
            $libro->save();
        });

        return $libro;
    }
}
