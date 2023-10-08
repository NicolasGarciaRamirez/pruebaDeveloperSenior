<?php

namespace App\Models\Balance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceHistory extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'user_id',       // ID del usuario al que pertenece la carga de saldo
        'amount',        // Monto de la carga de saldo (puede ser un valor decimal)
        'transaction_id', // ID de transacción o número de referencia (opcional)
	];

	protected $hidden = [
		'updated_at','deleted_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
