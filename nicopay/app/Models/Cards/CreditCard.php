<?php

namespace App\Models\Cards;

use App\Casts\CardNumberCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class CreditCard extends Model
{
    use HasFactory;

	protected $fillable = ['id', 'user_id', 'card_number', 'expiration_date'];

	protected $casts = [
		'card_number' => CardNumberCast::class
	];

	public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
