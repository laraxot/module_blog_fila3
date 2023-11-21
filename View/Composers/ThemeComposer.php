<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Illuminate\Database\Eloquent\Collection;
use Modules\Blog\Models\Post;

class ThemeComposer
{
    /**
     * Undocumented function.
     *
     * @return Collection<int, Post>
     */
    public function getPosts()
    {
        return Post::get();
    }
}
