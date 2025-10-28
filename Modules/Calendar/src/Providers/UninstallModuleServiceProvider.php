<?php

declare(strict_types=1);

namespace Modules\Calendar\Providers;

use Illuminate\Support\ServiceProvider;

class UninstallModuleServiceProvider extends ServiceProvider
{
    protected $module = 'Modules\Calendar';

    protected $moduleAlias = 'calendar';

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        app()->booted(function (): void {
            $this->booted();
        });
    }

    /**
     * Register the application services.
     */
    public function register(): void {}

    private function booted(): void
    {
        $this->dropSchema();
    }

    private function dropSchema(): void
    {
        // If you want to rollback your module migration
        // uncomment bellow statement

        //        \Artisan::call('module:migrate:rollback', ['alias' => $this->moduleAlias]);
    }
}
