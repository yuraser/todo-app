<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $status = Status::inRandomOrder()->first();

        $data = [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'priority' => rand(1, 5),
            'user_id' => $user->id,
            'status_id' => $status->id,
        ];

        $rand = rand(1, 30);
        if (
            $rand > 15 &&
            Task::all()->count() > 0
        ) {
            $task = Task::inRandomOrder()->first();
            $data['parent_id'] = $task->id;
        }

        return $data;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
    }
}
