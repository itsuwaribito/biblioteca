<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ubicacion;
use App\Seccion;
use App\Estante;

class UbicacionesController extends Controller
{
    public function update(Request $request, $id_seccion)
    {
        $seleccionados = collect($request->seleccionados)->pluck("id");
        $disponibles = collect($request->disponibles)->pluck("id");

        Ubicacion::where('secciones_id', $id_seccion)->whereIn('estantes_id', $disponibles)->delete();

        $seccion = Seccion::find($id_seccion);

        foreach ($seleccionados as $value) {
            $estante = Estante::find($value);
            $nombre = $seccion->nombre.' '.$estante->nombre;
            Ubicacion::firstOrCreate([
                'nombre' => $nombre,
                'secciones_id' => $id_seccion,
                'estantes_id' => $value
            ]);
        }
        
        return $request->all();
    }
}
