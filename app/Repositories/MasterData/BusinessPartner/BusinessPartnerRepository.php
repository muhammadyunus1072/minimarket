<?php

namespace App\Repositories\MasterData\BusinessPartner;

use App\Models\MasterData\BusinessPartner;
use App\Repositories\MasterDataRepository;

class BusinessPartnerRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return BusinessPartner::class;
    }

    public static function datatable()
    {
        return BusinessPartner::query();
    }
}
