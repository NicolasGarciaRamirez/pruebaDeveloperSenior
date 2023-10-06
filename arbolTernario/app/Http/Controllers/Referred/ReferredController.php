<?php

namespace App\Http\Controllers\Referred;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReferredController extends Controller
{
	public function index()
	{
		$userAuth = \Auth::user()->load('referidos');
		return Inertia::render('Referred/Referred', [
			'referidos' => $userAuth->referidos
		]);
	}
}
