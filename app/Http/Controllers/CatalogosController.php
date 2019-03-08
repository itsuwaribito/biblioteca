<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\Alumno;
use App\Seccion;
use App\Estante;

class CatalogosController extends Controller
{
    public function getLibros(Request $request)
    {
        $data = Libro::with('prestamos.alumno');

        if($request->all == "false")
        {
            $data->where('titulo','like',"%$request->search%")
            ->orWhere('autor','like',"%$request->search%")
            ->orWhere('editorial','like',"%$request->search%");
        }

        return $data->get();
    }

    public function getAlumnos()
    {
        $data = Alumno::all();
        return $data;
    }

    public function getSecciones()
    {
        $data = Seccion::all();
        return $data;
    }

    public function getEstantes(Request $request)
    {
        // Informacion por default
        $data = Estante::all();

        if($request->filled('seccion'))
        {
            $data = Estante::join('ubicaciones', 'estantes_id', '=', 'estantes.id')
                            ->where('secciones_id',$request->seccion)
                            ->get(['estantes.*']);
        }
        return $data;
    }
}