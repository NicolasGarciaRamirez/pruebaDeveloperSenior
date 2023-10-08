<?php

namespace App\Models\Transactions;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'amount',
		'description',
		'user_id'
	];

	protected $hidden = [
		'updated_at',
		'deleted_at'
	];

	protected $casts = [
		'created_at' => 'date'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
