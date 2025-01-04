<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=  $this->faker->words(2,true);
        return [
            'name' =>$name ,
            'slug' => Str::slug($name),
            'description'=> $this->faker->sentence(15),
            'iogo_image'=>$this->faker->imageUrl(300,300),
            'cover_image'=>$this->faker->imageUrl(800,600),
     
        ];
    }
}
