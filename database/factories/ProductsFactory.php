<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'summary' => $this->faker->text,
            'description' => $this->faker->text,
            'stock'=> $this->faker->numberBetween(2,45),
            'brand_id'=>$this->faker->randomElement(Brand::pluck('id')->toArray()),
            'vendor_id'=>$this->faker->randomElement(User::pluck('id')->toArray()),
            'cat_id'=>$this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_cat_id'=>$this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo'=>$this->faker->imageUrl('400','200'),
            'price'=>$this->faker->numberBetween(100,20000),
            'offer_price'=>$this->faker->numberBetween(100,10000),
            'discount'=>$this->faker->numberBetween(100,2000),
            'size'=>$this->faker->randomElement(['S','M','L']),
            'conditions'=>$this->faker->randomElement(['New','Popular','winter']),
            'Status'=>$this->faker->randomElement(['active','inactive']),






        ];
    }
}
