<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Core\Models\Setting::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'setting_key' => $this->faker->word(),
            'setting_value' => $this->faker->word(),
        ];
    }
}
