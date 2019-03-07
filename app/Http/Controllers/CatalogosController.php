<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\Alumno;

class CatalogosController extends Controller
{
    public function getLibros(Request $request)
    {
        $libros = Libro::with('prestamos.alumno');

        if($request->all == "false")
        {
            $libros->where('titulo','like',"%$request->search%")
            ->orWhere('autor','like',"%$request->search%")
            ->orWhere('editorial','like',"%$request->search%");
        }

        return $libros->get();
    }

    public function getAlumnos()
    {
        $alumnos = Alumno::all();
        return $alumnos;
    }
}
