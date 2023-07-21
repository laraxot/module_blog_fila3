<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Illuminate\Support\Collection;
use Modules\Blog\Models\Post;
use Modules\Xot\Datas\XotData;

class ThemeComposer
{
    /**
    * Undocumented function.
    *
    * @return Collection<Article>
    */
    public function getPosts(): Collection
    {
        return Post::get();
    }
}
