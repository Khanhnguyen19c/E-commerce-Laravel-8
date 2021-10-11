<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductFactory extends Factory
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
        $product_name = $this->faker->unique()->words($nb=4,$asText=true);
        $slug = Str::slug($product_name);
        return [
            'name' => $product_name,
            'slug' => $slug,
            'short_desc' => $this->faker->text(200),
            'desc' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(1200000,4000000),
            'SKU' => 'DIGI'.$this->faker->unique()->numberBetween(100,500),
            'stock_status' => 'Trong Kho',
            'quantity' => $this->faker->numberBetween(20,100),
            'image' => 'digital_'. $this->faker->unique()->numberBetween(1,22).'.jpg',
            'category_id' => $this->faker->numberBetween(1,2)
        ];
    }
}
