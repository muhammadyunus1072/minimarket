<?php

namespace App\Providers;

use Carbon\Carbon;
use Xendit\Configuration;
use App\Helpers\NumberFormatter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        $this->loadMigrationsFrom([
            database_path('migrations'), // Default
            database_path('migrations/master-data'),
        ]);

        Blade::directive('currency', function ($expression) {
            return "<?php echo App\Helpers\NumberFormatter::format($expression); ?>";
        });

        Blade::directive('date', function ($expression) {
            return "<?php echo $expression ? Carbon\Carbon::parse($expression)->translatedFormat('d F Y') : $expression; ?>";
        });
    }
}
