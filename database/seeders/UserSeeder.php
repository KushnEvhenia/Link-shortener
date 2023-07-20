<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'nobody',
            'email' => 'nobody@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::factory()
            ->count(5)
            ->create();
    }
}
