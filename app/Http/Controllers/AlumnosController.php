<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;

class AlumnosController extends Controller
{
    public function store(Request $request)
    {
        $dato = Alumno::create($request->all());
        return $dato;
    }

    public function update(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        $alumno->nombre = $request->nombre;
        $alumno->apellido_paterno = $request->apellido_paterno;
        $alumno->apellido_materno = $request->apellido_materno;
        $alumno->numero_control = $request->numero_control;
        $alumno->save();

        return $alumno;
    }
}
