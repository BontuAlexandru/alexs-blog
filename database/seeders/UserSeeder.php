<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'bontualexandru@gmail.com')->first();

        if (! $user) {
            User::create([
                'name' => 'Bontu Alexandru',
                'role' => 'admin',
                'email' => 'bontualexandru@gmail.com',
                'password' => Hash::make('asdqwe123')
            ]);
        }

    }
}
