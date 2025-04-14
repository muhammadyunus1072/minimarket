<?php

namespace App\Permissions;

class AccessMasterData
{
    const CASH_ACCOUNT = "cash_account";
    const PRODUCT = "product";
    const PRICE_LEVEL = "price_level";
    const BUSINESS_PARTNER = "business_partner";
    const PRODUCT_CATEGORY = "product_category";

    const ALL = [
        self::CASH_ACCOUNT,
        self::PRODUCT,
        self::PRICE_LEVEL,
        self::BUSINESS_PARTNER,
        self::PRODUCT_CATEGORY,
    ];

    const TYPE_ALL = [
        self::CASH_ACCOUNT => PermissionHelper::TYPE_ALL,
        self::PRODUCT => PermissionHelper::TYPE_ALL,
        self::PRICE_LEVEL => PermissionHelper::TYPE_ALL,
        self::BUSINESS_PARTNER => PermissionHelper::TYPE_ALL,
        self::PRODUCT_CATEGORY => PermissionHelper::TYPE_ALL,
    ];

    const TRANSLATE = [
        self::CASH_ACCOUNT => "Akun Kas",
        self::PRODUCT => "Produk",
        self::PRICE_LEVEL => "Level Harga",
        self::BUSINESS_PARTNER => "Mitra Bisnis",
        self::PRODUCT_CATEGORY => "Kategori Produk",
    ];
}
