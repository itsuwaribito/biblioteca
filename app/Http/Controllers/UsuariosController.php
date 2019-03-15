<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class UsuariosController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        $usuario = User::create($request->validated());
        return $usuario;
    }
    
    public function update(UpdateUserRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->fill($request->validated());
        $usuario->save();
        return $usuario;
    }

    public function destroy(Request $request, $id)
    {
        if($id == auth()->user()->id)
        {
            abort(403,'No se puede eliminar el usuario de esta sesion');
        }
        $usuario = User::destroy($id);
        return $usuario;
    }
}
