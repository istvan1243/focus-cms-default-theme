<?php

namespace Themes\FocusDefaultTheme\Classes\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Option;

class MaintenanceDefault extends Component
{
    /**
     * currentTheme
     *
     * @var mixed
     */
    public $currentTheme;
    public null|string $maintenanceSidebarContent;


    /**
     * Method __construct
     *
     * @param $currentTheme $currentTheme [explicite description]
     *
     * @return void
     */
    public function __construct()
    {
        $this->currentTheme = app('options.repository')->get('currentThemeName', 'FocusDefaultTheme');

        $maintenanceSidebarContent = Option::find("ts_FocusDefaultTheme_maintenance_content");

        $this->maintenanceSidebarContent = empty($maintenanceSidebarContent) ? null : (markdownToHtml($maintenanceSidebarContent->value));
    }

    /**
     * Method render
     *
     * @return View
     */
    public function render(): View
    {
        return view('theme::layouts.components.maintenance-default', [
            'currentTheme'  => $this->currentTheme,
            'maintenanceSidebarContent' => $this->maintenanceSidebarContent,
        ]);
    }
}