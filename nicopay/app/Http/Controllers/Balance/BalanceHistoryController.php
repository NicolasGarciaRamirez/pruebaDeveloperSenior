<?php

namespace App\Http\Controllers\Balance;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance\BalanceHistory;


class BalanceHistoryController extends Controller
{
	public function index()
    {
        $history = BalanceHistory::all();

        return Inertia::render('History/Index', [
            'history' => $history,
        ]);
    }

    public function create()
    {
        return Inertia::render('History/Create');
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'amount' => 'required|numeric|min:0',
            // Agrega otras reglas de validación según tus necesidades
        ]);

        // Guarda la carga de saldo en la base de datos
        BalanceHistory::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->input('amount'),
            // Agrega otros campos según tus necesidades
        ]);

        return redirect()->route('history.index')
            ->with('success', 'Carga de saldo creada con éxito');
    }

    public function show(BalanceHistory $history)
    {
        return Inertia::render('History/Show', [
            'history' => $history,
        ]);
    }

    public function edit(BalanceHistory $history)
    {
        return Inertia::render('History/Edit', [
            'history' => $history,
        ]);
    }

    public function update(Request $request, BalanceHistory $history)
    {
        // Valida los datos del formulario
        $request->validate([
            'amount' => 'required|numeric|min:0',
            // Agrega otras reglas de validación según tus necesidades
        ]);

        // Actualiza el registro de carga de saldo en la base de datos
        $history->update([
            'amount' => $request->input('amount'),
            // Actualiza otros campos según tus necesidades
        ]);

        return redirect()->route('history.index')
            ->with('success', 'Carga de saldo actualizada con éxito');
    }

    public function destroy(BalanceHistory $history)
    {
        // Elimina el registro de carga de saldo de la base de datos
        $history->delete();

        return redirect()->route('history.index')
			->with('success', 'Carga de saldo eliminada con éxito');
    }
}
