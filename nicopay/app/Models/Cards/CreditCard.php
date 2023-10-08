<?php

namespace App\Models\Cards;

use App\Casts\CardNumberCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCard extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = ['id', 'user_id', 'card_name','card_number', 'expiration_date'];

	protected $casts = [
		'card_number' => CardNumberCast::class
	];

	public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
