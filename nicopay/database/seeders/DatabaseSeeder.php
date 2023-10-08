<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\Cards\ApiToken;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
		if(!$user = User::whereName('Test Nicolas')->first()){
			$user = \App\Models\User::create([
				'name' => 'Test Nicolas',
				'email' => 'nicolas@nicolas.com',
				'password' => Hash::make('123')
			]);
		}

		$apiToken = new ApiToken();
		$apiToken->name = 'apiToken';
		$apiToken->key_secret = Hash::make(Str::random(8));
		$apiToken->key_public = Hash::make(Str::random(8));
		$user->apiToken()->save($apiToken);
    }
}
