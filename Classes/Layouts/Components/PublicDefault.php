<?php

namespace Themes\FocusDefaultTheme\Classes\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PublicDefault extends Component
{
    public $footerSidebar1;
    public $footerSidebar2;
    public $footerSidebar3;

    public function __construct($footerSidebar1 = [], $footerSidebar2 = [], $footerSidebar3 = [])
    {
        $this->footerSidebar1 = $footerSidebar1;
        $this->footerSidebar2 = $footerSidebar2;
        $this->footerSidebar3 = $footerSidebar3;
    }

    public function render(): View
    {
        return view('theme::layouts.components.public-default', [
            'footerSidebar1' => $this->footerSidebar1,
            'footerSidebar2' => $this->footerSidebar2,
            'footerSidebar3' => $this->footerSidebar3,
        ]);
    }
}