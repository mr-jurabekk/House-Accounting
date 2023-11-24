<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function Ramsey\Uuid\Generator\timestamp;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(3, 13),
            'type_id' => 2,
            'category_id' => rand(3, 8),
            'sum' => rand(50000, 100000),
            'comment' => fake()->sentence(3),
            'date' => $this->faker->time('Y-m-d H:i:s'),

        ];
    }
}
