<?php

namespace App\Repositories\MasterData\ProductCategory;

use App\Models\MasterData\ProductCategory;
use App\Repositories\MasterDataRepository;

class ProductCategoryRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ProductCategory::class;
    }

    public static function datatable()
    {
        return ProductCategory::query();
    }
}
