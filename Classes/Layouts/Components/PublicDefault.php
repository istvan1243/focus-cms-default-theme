<?php

namespace Themes\FocusDefaultTheme\Classes\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PublicDefault extends Component
{
    /**
     * currentTheme
     *
     * @var mixed
     */
    public $currentTheme;


    /**
     * Method __construct
     *
     * @param $currentTheme $currentTheme [explicite description]
     *
     * @return void
     */
    public function __construct($currentTheme = null)
    {
        $this->currentTheme = $currentTheme;
    }

    /**
     * Method render
     *
     * @return View
     */
    public function render(): View
    {
        $footerSidebar1 = $this->getSampleWidgets();
        $footerSidebar2 = $this->getSampleWidgets();
        $footerSidebar3 = $this->getSampleWidgets();

        return view('theme::layouts.components.public-default', [
            'currentTheme'  => $this->currentTheme,
            'footerSidebar1' => $footerSidebar1,
            'footerSidebar2' => $footerSidebar2,
            'footerSidebar3' => $footerSidebar3,
        ]);
    }

    /**
     * Method getSampleWidgets
     *
     * @return void
     */
    private function getSampleWidgets()
    {
        return [
            ["title" => "Widget 1", "content" => "Ez egy minta widget tartalma."],
            ["title" => "Widget 2", "content" => "Egy másik widget tartalma."],
            ["title" => "Widget 3", "content" => "Még egy widget példaként."],
        ];
    }
}