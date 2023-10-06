<?php

namespace App\Models\Cards;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'key_public','key_secret'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
