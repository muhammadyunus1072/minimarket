<?php

namespace Database\Seeders\MasterData;

use App\Repositories\MasterData\PriceLevel\PriceLevelRepository;
use Illuminate\Database\Seeder;

class PriceLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PriceLevelRepository::create([
            'name' => 'retail',
        ]);
    }
}
