<?php

namespace Modules\Projects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Projects\Models\Project;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Projects\Models\Task::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'task_name'        => $this->faker->sentence(),
            'task_status'      => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'task_finish_date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'project_id'       => Project::factory(),
        ];
    }
}
