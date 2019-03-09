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
}
