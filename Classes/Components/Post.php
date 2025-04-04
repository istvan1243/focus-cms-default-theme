<?php

namespace Themes\FocusDefaultTheme\Classes\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Post extends Component
{
    /**
     * post
     *
     * @var mixed
     */
    public $post;


    /**
     * Method __construct
     *
     * @param $post $post [explicite description]
     *
     * @return void
     */
    public function __construct($post)
    {
        $post->content = markdownToHtml($post->content);
        $this->post = $post;
    }

    /**
     * Method render
     *
     * @return View
     */
    public function render(): View
    {
        return view('theme::components.post', [
            'post'  => $this->post
        ]);
    }
}