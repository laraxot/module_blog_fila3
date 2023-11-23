<?php

declare(strict_types=1);

namespace Modules\Blog\View\Components\Article;

use Illuminate\View\Component;

// use Modules\Xot\View\Components\XotBaseComponent;

/**
 * Class Field.
 */
class Card extends Component
{
    public function render()
    {
        $view='blog::article.card';
        $view_params=[];
        return view($view,$view_params);
    }
}
