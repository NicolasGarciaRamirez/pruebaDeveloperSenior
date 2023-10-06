<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test 1',
            'email' => 'test1@example.com',
			'password' => Hash::make('Saray1402*'),
			'level' => 0
        ]);
		\App\Models\User::factory()->create([
            'name' => 'Test 2',
            'email' => 'test2@example.com',
			'password' => Hash::make('Saray1402*'),
			'patrocinador_id' => 1,
			'level' => 1
        ]);
    }
}
