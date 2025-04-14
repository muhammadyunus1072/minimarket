<?php

namespace App\Repositories\MasterData\PriceLevel;

use App\Models\MasterData\PriceLevel;
use App\Repositories\MasterDataRepository;

class PriceLevelRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return PriceLevel::class;
    }

    public static function datatable()
    {
        return PriceLevel::query();
    }
}
