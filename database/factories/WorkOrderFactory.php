<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkOrder>
 */
class WorkOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'description' => fake()->sentence(),
            'location' => fake()->city(),
            'priority' => fake()->randomElement(['baixa', 'média', 'alta']),
            'category' => fake()->randomElement(['elétrica', 'hidraulica', 'pintura']),
            'status' => fake()->randomElement(['aberta', 'em_andamento', 'finalizada', 'cancelada']),
            'feedback' => fake()->sentence(),
            'feedback_note' => fake()->numberBetween(1, 5),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
