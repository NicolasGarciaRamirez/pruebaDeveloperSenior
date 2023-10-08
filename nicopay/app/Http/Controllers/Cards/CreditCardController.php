<?php

namespace App\Http\Controllers\Cards;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Cards\CreditCard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

class CreditCardController extends Controller
{

	public function index()
	{
		$response = auth()->user()->load('creditCards','balance');
 		return Inertia::render('Cards/index', ['response'=>$response->creditCards, 'user' => $response]);
	}


    public function save(Request $request)
	{
		$request->validate([
			'card_name' => 'required',
			'card_number' => 'required',
			'expiration_date' => 'required',
			'card_cvv' => 'required'
		]);
		$user = Auth::user();
		$creditCard = new CreditCard($request->all());
		$user->creditCards()->save($creditCard);
		$responseData = [
			'errors' => false,
			'saved' => true,
			'user' => $user->refresh()->load('creditCards'),
			'credit_card' => $creditCard
		];
		if($request->ajax()){
			return Inertia::render('Cards/index', ['response'=>$responseData]);
		}else{
			return response()->json($responseData, Response::HTTP_OK);
		}
	}

	public function update(Request $request)
	{
		$request['card_number'] = Crypt::encrypt($request->input('card_number'));
		$user = Auth::user();
		$creditCard = new CreditCard($request->all());
		$user->creditCards()->save($creditCard);

		return response()->json([
			'errors' => false,
			'saved' => true,
			'user' => $user->refresh()->load('creditCards')
		], Response::HTTP_OK);
	}

	public function delete($creditCardId)
	{
		try {
			$creditCardId->forceDelete();
			
			return response()->json([
				'errors' => false,
				'saved' => true,
				'user' => auth()->user()->refresh()->load('creditCards')
			], Response::HTTP_OK);
		} catch (\Throwable $th) {
			return response()->json([
				'errors' => false,
				'saved' => true,
				'user' => auth()->user()->refresh()->load('creditCards')
			], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

}
