<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los clientes
        $clients = User::all();
        return view('users', ['clients' => $clients]);
    }

	public function getDatatable()
	{
		$clients = \App\Models\User::with('patrocinador')->get();
		return DataTables::of($clients)->addColumn('patrocinador_name', function($client){
			return $client->patrocinador?->name;
		})->make();
	}

    public function store(Request $request)
    {
        // Validar y crear un nuevo cliente
        $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:users',
            'patrocinador_id' => 'nullable|exists:users,id',
        ]);

        $cliente = User::create($request->all());

        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        // Obtener un cliente por su ID
        $cliente = User::findOrFail($id);

        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        // Validar y actualizar un cliente
        $cliente = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:clientes,correo,' . $id,
            'patrocinador_id' => 'nullable|exists:clientes,id',
        ]);

        $cliente->update($request->all());

        return response()->json($cliente);
    }

    public function destroy($id)
    {
        // Eliminar un cliente por su ID
        $cliente = User::findOrFail($id);
        $cliente->delete();

        return response()->json(null, 204);
    }
}
