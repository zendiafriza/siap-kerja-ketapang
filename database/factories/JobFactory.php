<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'sector' => $this->faker->word(),
            'type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Freelance', 'Magang']),
            'description' => $this->faker->paragraph(),
            'salary' => $this->faker->numberBetween(3000000, 10000000),
            'hide_salary' => false,
            'match_score' => $this->faker->numberBetween(50, 100),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'is_featured' => false,
        ];
    }
}
