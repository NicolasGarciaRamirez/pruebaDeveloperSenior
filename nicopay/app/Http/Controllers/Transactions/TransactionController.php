<?php

namespace App\Http\Controllers\Transactions;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transactions\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
		$user = auth()->user()->load('balance');

        $transactions = Transaction::whereUserId($user->id)->latest()->paginate(10);
        return Inertia::render('Transactions/index', [
            'transactions' => $transactions,
			'user' => $user
        ]);
    }

    public function create()
    {
        return Inertia::render('Transactions/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            // Agrega otras reglas de validación según tus necesidades
        ]);

        Transaction::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->input('amount'),
            // Agrega otros campos según tus necesidades
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transacción creada con éxito');
    }

    public function show(Transaction $transaction)
    {
        return Inertia::render('Transactions/Show', [
            'transaction' => $transaction,
        ]);
    }

    public function edit(Transaction $transaction)
    {
        return Inertia::render('Transactions/Edit', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            // Agrega otras reglas de validación según tus necesidades
        ]);

        $transaction->update([
            'amount' => $request->input('amount'),
            // Actualiza otros campos según tus necesidades
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transacción actualizada con éxito');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transacción eliminada con éxito');
    }
}
