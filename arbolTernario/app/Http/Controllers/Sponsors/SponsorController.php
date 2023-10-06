<?php

namespace App\Http\Controllers\Sponsors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SponsorController extends Controller
{
    public function index()
	{
		$userAuth = \Auth::user()->load('patrocinador.referidos');
		return Inertia::render('Sponsors/Sponsor', [
			'sponsor' => $userAuth->patrocinador
		]);
	}
}
