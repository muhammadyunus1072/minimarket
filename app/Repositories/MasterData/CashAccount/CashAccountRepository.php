<?php

namespace App\Repositories\MasterData\CashAccount;

use App\Models\MasterData\CashAccount;
use App\Repositories\MasterDataRepository;

class CashAccountRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return CashAccount::class;
    }

    public static function datatable()
    {
        return CashAccount::query();
    }
}
