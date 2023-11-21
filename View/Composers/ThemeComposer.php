<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Modules\Blog\Models\Post;

class ThemeComposer
{
    /**
     * Undocumented function.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int,\Modules\Blog\Models\Post>
     */
    public function getPosts()
    {
        return Post::get();
    }
}
