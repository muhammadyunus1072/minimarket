<?php

namespace Database\Seeders\MasterData;

use Illuminate\Database\Seeder;
use App\Repositories\MasterData\BusinessPartner\BusinessPartnerRepository;

class BusinessPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusinessPartnerRepository::create([
            'name' => 'CUSTOMER RETAIL',
            'price_level_id' => 1,
            'address' => null,
            'phone' => null,
            'phone' => null,
            'is_customer' => true,
            'is_supplier' => false,
            'is_active' => true,
        ]);
    }
}
