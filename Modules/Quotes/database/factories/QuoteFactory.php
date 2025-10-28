<?php

namespace Modules\Quotes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Clients\Models\Client;

class QuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Quotes\Models\Quote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'quote_status_id' => $this->faker->numberBetween(1, 4),
            'quote_number' => 'QUO-' . $this->faker->unique()->numberBetween(1000, 9999),
            'quote_date_created' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'quote_total' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}

