<?php

namespace Database\Factories\ManagementModel;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PermissionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(permission());

        $slug = explode('.',$name['name']);
        $slug = implode('-',$slug);
        //dd($slug);
        return [
            'name' => $name['name'],
            'slug' => $slug,
        ];
    }
}
