<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uid' => uniqid(),
            'title' => fake()->sentence(2),
            'description' => fake()->paragraph(5),
            'publish_date' => Carbon::today(),
            'approved' => random_int(0,1),
            'user_id' => fake()->randomElement([1,3]),
        ];
    }
}
