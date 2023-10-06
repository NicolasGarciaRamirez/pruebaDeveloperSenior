<?php

namespace App\Http\Controllers\Esquema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class EsquemaController extends Controller
{
    public function index()
	{
		// Obtener niveles únicos presentes en la base de datos.
		$levels = User::distinct()->pluck('level');
		// Recuperar usuarios agrupados por nivel.
		$usersByLevel = User::whereIn('level', $levels)->get()->groupBy('level');

		return Inertia::render('Estructura/Estructura', [
			'users' => $usersByLevel
		]);
	}
}
