<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\User;

class UsuariosController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        $usuario = User::create($request->validated());
        return $usuario;
    }

    public function update(Request $request, $id)
    {
        // 
    }

    public function destroy(Request $request, $id)
    {
        // 
    }
}
