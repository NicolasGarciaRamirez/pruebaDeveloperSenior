<?php

namespace App\Models\Balance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'amount',     // valor del dinero actual
		'currency',   // moneda en la que recibe la transaccion
		'user_id'     // ID del usuario al que pertenece el saldo
	];

	protected $hidden = [
		'updated_at','deleted_at'
	];
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
