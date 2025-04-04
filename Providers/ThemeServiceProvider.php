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

        $currentThemeName = $this->getCurrentThemeName();
        $this->registerThemeViews($currentThemeName);
        $this->registerThemeComponents();
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
            \Themes\FocusDefaultTheme\Classes\Layouts\Components\PublicDefault::class => 'public-default'
        ];

        foreach ($components as $class => $tag) {
            if (!class_exists($class)) {
                throw new \RuntimeException("Component class not found: {$class}");
            }
            Blade::component($class, $tag);
        }
    }
}