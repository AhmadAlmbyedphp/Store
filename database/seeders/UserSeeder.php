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
        User::create([
           'name'=>'ahmad fared',
           'email'=>'a@almbyed.php',
           'password'=>Hash::make('123456'),
           'phone_number'=>'0592240626'
        ]);
     
    }
}
