<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wizard>
 */
class WizardFactory extends Factory
{

    protected $model = \App\Models\Wizard::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(1, 100),
            'magic_level' => $this->faker->numberBetween(1, 50),
        ];
    }
}
