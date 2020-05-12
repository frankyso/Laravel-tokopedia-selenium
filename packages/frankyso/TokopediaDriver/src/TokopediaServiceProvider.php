<?php

namespace Frankyso\Tokopedia;

use App\Services\WhatsAppDriver\WhatsAppManager;
use Illuminate\Support\ServiceProvider;

class TokopediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Frankyso\Tokopedia', function (Container $app) {
            $manager = new TokopediaManager();
            return $manager;
        });
//        $this->app->alias('frankyso.whatsapp', TenantiManager::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/tokopedia.php', 'tokopedia'
        );
    }
}
