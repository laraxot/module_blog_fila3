<?php

namespace Modules\Blog\Filament\Resources\PostResource\Widgets;

use Modules\Blog\Models\Post;
use Modules\Blog\Models\PostView;
use Modules\Blog\Models\UpvoteDownvote;
use Filament\Widgets\Widget;

class PostOverview extends Widget
{
    public Post $record;

    protected int | string | array $columnSpan = 3;

    protected static string $view = 'filament.resources.post-resource.widgets.post-overview';

    protected function getViewData(): array
    {
        return [
            'viewCount' => PostView::where('post_id', '=', $this->record->id)->count(),
            'upvotes'   => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 1)->count(),
            'downvotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 0)->count(),
        ];
    }
}
