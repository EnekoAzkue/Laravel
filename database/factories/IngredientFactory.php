<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{

    protected $model = \App\Models\Ingredient::class;

    public function definition(): array
    {
        return [
            'ingredient_name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(1, 100),
            'rarity' => $this->faker->word(),
        ];
    }
}
