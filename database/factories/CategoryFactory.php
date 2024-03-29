<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word,
            'slug'=>$this->faker->unique()->slug(),
            'summary'=>$this->faker->sentences(3,true),
            'photo'=>$this->faker->imageUrl('100','100'),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'is_parent'=>$this->faker->randomElement([true,false]),
            'parent_id'=>$this->faker->randomElement(Category::pluck('id')->toArray()),

        ];
    }
}
