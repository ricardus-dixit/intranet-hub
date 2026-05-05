<?php

namespace App\Providers;

use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Support\Icons\Heroicon;
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
        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                // ->panels([
                    // 'admin',
                    // 'portal'
                // ])
                ->simple()
                ->labels([
                    'admin' => 'Super Admin',
                    'portal' => __('Personal Portal')
                ])
                ->icons([
                    'admin' => Heroicon::ShieldCheck,
                    'portal' => Heroicon::UserCircle
                ])
                ->sort();
        });
    }
}
