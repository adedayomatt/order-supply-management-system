<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Adedayo',
            'lastname' => 'Matthew',
            'email' => 'adedayomatt@gmail.com',
            'phone' => '08139004572',
            'position' => 4,
            'password' => Hash::make('pass')
        ]);
    }
}
