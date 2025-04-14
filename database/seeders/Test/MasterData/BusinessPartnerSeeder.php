<?php

namespace Database\Seeders\Test\MasterData;

use App\Repositories\MasterData\BusinessPartner\BusinessPartnerRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BusinessPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i=0; $i < 20; $i++) { 
            BusinessPartnerRepository::create([
                'price_level_id' => 1,
                'name' => $faker->name(),
                'address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
                'is_customer' => $faker->randomElement([true, false]),
                'is_supplier' => $faker->randomElement([true, false]),
                'is_active' => 1,
            ]);
        }
    }
}
