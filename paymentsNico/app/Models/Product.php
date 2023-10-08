<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = ['name', 'description', 'price', 'stock', 'image', 'user_id', 'category_id'];

	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
