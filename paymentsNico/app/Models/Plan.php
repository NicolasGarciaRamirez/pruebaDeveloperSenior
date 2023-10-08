<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = ['name','description','price','time'];

	protected $hidden = ['created_at','updated_at','deleted_at'];

	public function services()
	{
		return $this->belongsToMany(Service::class);
	}
}
