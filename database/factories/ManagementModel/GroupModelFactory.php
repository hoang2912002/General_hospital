<?php

namespace Database\Factories\ManagementModel;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManagementModel\GroupModel>
 */
class GroupModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'Quản lý';
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'activated' => 1
        ];
    }
}
