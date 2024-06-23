<?php

namespace Database\Seeders\ManagementModel;

use App\Models\ManagementModel\PaymentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentModel::factory()->count(3)->create();
    }
}
