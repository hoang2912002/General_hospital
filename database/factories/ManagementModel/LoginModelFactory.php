<?php

namespace Database\Factories\ManagementModel;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManagementModel\LoginModel>
 */
class LoginModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => 'management@gmail.com',
            'password' => bcrypt(123456),
            'phone_number' => '0363157313',
            'activated' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ];
    }
}
