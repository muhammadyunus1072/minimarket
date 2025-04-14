<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\MasterData\BusinessPartnerSeeder;
use Database\Seeders\MasterData\PriceLevelSeeder;
use Database\Seeders\Test\MasterData\ProductCategorySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\User\RoleSeeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\User\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PriceLevelSeeder::class,
            BusinessPartnerSeeder::class,
        ]);
        
        // TEST
        $this->call([
            ProductCategorySeeder::class,
        ]);
    }
}
