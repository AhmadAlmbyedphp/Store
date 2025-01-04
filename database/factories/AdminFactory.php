<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'name' => $this->faker->name,
             'email' => $this->faker->unique()->safeEmail,
             'username' => $this->faker->unique()->userName,
             'password' => Hash::make('password'),
             'phone_number' => $this->faker->phoneNumber,
             'super_admin' => $this->faker->boolean,


        ];
    }
}
