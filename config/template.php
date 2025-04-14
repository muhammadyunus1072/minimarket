<?php

return [
    'title' => env('APP_NAME', 'Booking System'),
    'subtitle' => 'Self Studio - Photobox - Pas Foto',

    'logo_auth' => 'files/images/logo.png',
    'logo_auth_background' => 'white',

    'logo_panel' => 'files/images/logo_long.png',
    'logo_panel_background' => 'white',
    
    'superadmin_role' => env('SUPERADMIN_ROLE', 'Super Admin'),
    'admin_role' => env('ADMIN_ROLE', 'Admin'),
    'cashier_role' => env('CASHIER_ROLE', 'Cashier'),
    'member_role' => env('MEMBER_ROLE', 'Member'),

    'registration_route' => 'register',
    'registration_default_role' => 'Member',

    'forgot_password_route' => 'password.request',
    'reset_password_route' => 'password.reset',

    // 'email_verification_route' => 'verification.index',
    'email_verification_route' => '',
    'email_verification_delay_time' => 30,

    'email_verify_route' => 'verification.verify',

    'profile_route' => 'profile',
    'profile_image' => 'assets/media/avatars/profile.png',

    'menu' => [
        [
            'text' => 'Dashboard',
            'route'  => 'dashboard.index',
            'icon' => 'ki-duotone ki-element-11',
            'description' => 'Dashboard',
        ],
        [
            // 'id' => 'menu_admin'
            'text' => 'Master Data',
            'icon' => 'ki-duotone ki-shield-tick',
            'submenu' => [
                [
                    'text' => 'Akun Kas',
                    'route' => 'cash_account.index',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Mitra Bisnis',
                    'route' => 'business_partner.index',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Kategori Produk',
                    'route' => 'product_category.index',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Produk',
                    'route' => 'product.index',
                    'icon_color' => 'primary',
                ],
            ],
        ],
        [
            // 'id' => 'menu_admin'
            'text' => 'Admin',
            'icon' => 'ki-duotone ki-shield-tick',
            'submenu' => [
                [
                    'text' => 'Pengguna',
                    'route' => 'user.index',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Jabatan',
                    'route' => 'role.index',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Akses',
                    'route' => 'permission.index',
                    'icon_color' => 'primary',
                ],
            ],
        ],
    ],
];
