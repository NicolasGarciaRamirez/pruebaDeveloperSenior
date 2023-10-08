<?php

namespace App\Http\Controllers\Balance;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance\BalanceHistory;
use App\Models\Transactions\Transaction;

class BalanceController extends Controller
{
	public function index()
    {
		$user = auth()->user()->load('balance');
        return Inertia::render('Balance/index', ['user' => $user]);
    }

    public function store(Request $request)
    {
		$user = auth()->user();
        // Valida los datos del formulario según tus necesidades
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

		$transaction = new Transaction();
		$transaction->amount = $request->input('amount');
		$transaction->name = 'Carga De Saldo';
		$transaction->description = 'Carga Saldo Administrator';
		$user->transactions()->save($transaction);
        // Guarda la carga de saldo en la tabla de historial
        $balance = new BalanceHistory($request->all());
		$balance->user_id = auth()->user()->id;
		$balance->amount = $request->input('amount');
		$balance->transaction_id = $transaction->id;
		$balance->save();
        // Realiza cualquier otra lógica necesaria para actualizar el saldo del usuario

        // Redirige a la página de historial de saldo
		return Inertia::render('Balance/index', ['user' => $user->load('balance')]);

    }

    public function show()
    {
        $history = BalanceHistory::where('user_id', auth()->user()->id)->get();

        return Inertia::render('Balance/History', ['history' => $history]);
    }
}
