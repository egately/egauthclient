<?php

namespace Egately\EgateAuthClient;

use Egately\EgateAuthClient\Http\Controllers\EgateAuthController;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Egately\EgateAuthClient\Commands\EgateAuthClientCommand;

class EgateAuthClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('egauthclient')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_egauthclient_table')
            ->hasCommand(EgateAuthClientCommand::class);
    }

    public function packageRegistered()
    {
        //Routes
        Route::get('/egate-login', [EgateAuthController::class, 'create'])->name('egate.login.show');
        Route::post('egate-login', [EgateAuthController::class, 'store'])->name('egate.login.store');
    }
}
