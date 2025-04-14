<?php

namespace Database\Seeders\Test\MasterData;

use Illuminate\Database\Seeder;
use App\Repositories\MasterData\ProductCategory\ProductCategoryRepository;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategoryRepository::create([
            'name' => 'MAKANAN',
        ]);
        ProductCategoryRepository::create([
            'name' => 'MINUMAN',
        ]);
        ProductCategoryRepository::create([
            'name' => 'MIE INSTAN',
        ]);
        ProductCategoryRepository::create([
            'name' => 'DETERJEN',
        ]);
        ProductCategoryRepository::create([
            'name' => 'OBAT',
        ]);
    }
}
