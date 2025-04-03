<?php

namespace Themes\FocusDefaultTheme\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Option;
use Illuminate\Support\Facades\Blade;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Ha szükséges, ide kerülhet bármilyen más regisztrációs logika

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // Aktuális téma lekérése az adatbázisból
        $option = Option::find('currentThemeName');
        $currentThemeName = $option ? $option->value : 'FocusDefaultTheme';

        // A nézetek helyes útvonalának regisztrálása
        $themePath = base_path("Themes/{$currentThemeName}/resources/views");

        // Laravel számára regisztráljuk a nézetek elérési útját
        $this->loadViewsFrom($themePath, 'theme');

        // Nézet névtér hozzáadása
        View::addNamespace('theme', $themePath);

        // Blade komponensek regisztrálása
        Blade::component(\Themes\FocusDefaultTheme\Classes\Layouts\Components\PublicDefault::class, 'public-default');
    }
}