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
    public null|array $sidebars;


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

        $sidebars = Option::where('name', 'like', "ts_{$this->currentTheme}_sidebar_%")
            ->get()
            ->pluck('value', 'name')
            ->toArray();

        $sidebarsRendered = [];

        if (!empty($sidebars)) {
            foreach ($sidebars as $key => &$val) {
                $val = empty($val) ? null : markdownToHtml($val);
            }
        }

        $this->sidebars = $sidebars;
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
            'sidebars' => $this->sidebars,
        ]);
    }
}