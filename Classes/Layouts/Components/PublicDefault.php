<?php

namespace Themes\FocusDefaultTheme\Classes\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Option;

class PublicDefault extends Component
{
    /**
     * currentTheme
     *
     * @var mixed
     */
    public $currentTheme;
    public null|string $isMinimalViewFromController;
    public null|string $topSidebarContent;
    public null|string $bottomSidebarContent;
    public null|string $rightSidebarContent;


    /**
     * Method __construct
     *
     * @param $currentTheme $currentTheme [explicite description]
     *
     * @return void
     */
    public function __construct($isMinimalViewFromController = null)
    {
        $this->currentTheme = app('options.repository')->get('currentThemeName', 'FocusDefaultTheme');
        $this->isMinimalViewFromController = $isMinimalViewFromController;

        $topNavContent = Option::find("ts_FocusDefaultTheme_top-nav_content");
        $topSidebarContent = Option::find("ts_FocusDefaultTheme_top-sidebar_content");
        $bottomSidebarContent = Option::find("ts_FocusDefaultTheme_bottom-sidebar_content");
        $rightSidebarContent = Option::find("ts_FocusDefaultTheme_right-sidebar_content");

        $this->topNavContent = empty($topNavContent) ? null : (markdownToHtml($topNavContent->value));
        $this->topSidebarContent = empty($topSidebarContent) ? null : (markdownToHtml($topSidebarContent->value));
        $this->bottomSidebarContent = empty($bottomSidebarContent) ? null : markdownToHtml($bottomSidebarContent->value);
        $this->rightSidebarContent = empty($rightSidebarContent) ? null : markdownToHtml($rightSidebarContent->value);

    }

    /**
     * Method render
     *
     * @return View
     */
    public function render(): View
    {
        return view('theme::layouts.components.public-default', [
            'currentTheme'  => $this->currentTheme,
            'isMinimalViewFromController' => $this->isMinimalViewFromController,
            'topNavContent' => $this->topNavContent,
            'topSidebarContent' => $this->topSidebarContent,
            'bottomSidebarContent' => $this->bottomSidebarContent,
            'rightSidebarContent' => $this->rightSidebarContent,
        ]);
    }
}