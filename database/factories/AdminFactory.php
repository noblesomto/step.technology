<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = \App\Models\Admin::class;

    public function definition()
    {
        return [
            'admin_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'username' => $this->faker->unique()->userName(),
            'password' => 'password', // hashed automatically by the model's 'hashed' cast
        ];
    }
}
