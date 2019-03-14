<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\Alumno;
use App\Seccion;
use App\Estante;
use App\Ubicacion;

class CatalogosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('getLibros');
    }

    public function getLibros(Request $request)
    {
        $data = Libro::with(['alumnosPendientes','alumnosNoPendientes']);

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
        $data = Alumno::with('librosPrestados','librosDebueltos')->get();
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

    public function getUbicaciones()
    {
        return Ubicacion::with('estante','seccion')->get();
    }
}
