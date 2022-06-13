<?php

declare(strict_types=1);

namespace Krafjp\Dd;

use Illuminate\Support\ServiceProvider;

class DdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DdSetupCommand::class,
                DdGenerateCommand::class,
            ]);
        }
    }
}