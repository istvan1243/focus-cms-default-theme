<?php

namespace Themes\FocusDefaultTheme\Providers;

use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('options')) {

            $currentThemeName = $this->getCurrentThemeName();
            $this->registerThemeViews($currentThemeName);
            $this->registerThemeComponents();
            $this->registerThemeConfig();
        }
    }

    /**
     * Method getCurrentThemeName
     *
     * @return string
     */
    protected function getCurrentThemeName(): string
    {
        $option = Option::find('currentThemeName');
        return $option ? $option->value : 'FocusDefaultTheme';
    }

    /**
     * Method registerThemeViews
     *
     * @param string $themeName [explicite description]
     *
     * @return void
     */
    protected function registerThemeViews(string $themeName): void
    {
        $themePath = base_path("Themes/{$themeName}/resources/views");

        // Hibakezelés hozzáadása
        if (!file_exists($themePath)) {
            throw new \RuntimeException("Theme views directory not found: {$themePath}");
        }

        $this->loadViewsFrom($themePath, 'theme');
        View::addNamespace('theme', $themePath);
    }

    /**
     * Method registerThemeComponents
     *
     * @return void
     */
    protected function registerThemeComponents(): void
    {
        // Komponensek regisztrációja közvetlenül a saját névterükkel
        $components = [
            \Themes\FocusDefaultTheme\Classes\Components\Post::class => 'post',
            \Themes\FocusDefaultTheme\Classes\Layouts\Components\PublicDefault::class => 'public-default',
            \Themes\FocusDefaultTheme\Classes\Layouts\Components\MaintenanceDefault::class => 'maintenance-default'
        ];

        foreach ($components as $class => $tag) {
            if (!class_exists($class)) {
                throw new \RuntimeException("Component class not found: {$class}");
            }
            Blade::component($class, $tag);
        }
    }

    /**
     * Method registerThemeConfig
     *
     * @return void
     */
    protected function registerThemeConfig(): void
    {
        $themeName = $this->getCurrentThemeName();
        $configPath = base_path("Themes/{$themeName}/config");

        // Ha létezik a config mappa
        if (file_exists($configPath)) {
            // Összes config fájl betöltése
            $configFiles = glob($configPath.'/*.php');

            foreach ($configFiles as $configFile) {
                $key = pathinfo($configFile, PATHINFO_FILENAME);
                $this->mergeConfigFrom($configFile, "theme.{$key}");
            }
        }
    }

}