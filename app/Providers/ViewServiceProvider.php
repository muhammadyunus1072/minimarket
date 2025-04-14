<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $role = auth()->check() ? auth()->user()->getRoleNames()->first() : null;

            $layout = match ($role) {
                config('template.superadmin_role') => 'app.layouts.admin-panel',
                config('template.admin_role') => 'app.layouts.admin-panel',
                config('template.cashier_panel') => 'app.layouts.cashier-panel',
                config('template.member_panel') => 'app.layouts.member-panel',
            };

            $view->with('layout', $layout);
        });
    }
}
