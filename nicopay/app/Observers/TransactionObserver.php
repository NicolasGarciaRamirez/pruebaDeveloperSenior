<?php

namespace App\Observers;

use App\Models\Transactions\Transaction;

class TransactionObserver
{
    public function created(Transaction $transaction)
    {
        // Cuando se crea una transacción, actualiza el balance del usuario
        $user = $transaction->user;
        if ($user->balance) {
            // Si el usuario ya tiene un balance, actualiza su monto
            $user->balance->update([
                'amount' => $user->balance->amount + $transaction->amount,
            ]);
        } else {
            // Si el usuario no tiene un balance, crea uno nuevo
            $user->balance()->create([
                'amount' => $transaction->amount,
				'currency' => 'COP'
            ]);
        }
    }

    public function deleted(Transaction $transaction)
    {
        // Cuando se elimina una transacción, resta el monto del balance del usuario
        $user = $transaction->user;
        if ($user->balance) {
            // Si el usuario tiene un balance, resta el monto
            $user->balance->update([
                'amount' => $user->balance->amount - $transaction->amount,
				'currency' => 'COP'
            ]);
        }
    }
}
