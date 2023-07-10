<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Modules\Blog\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;
use Savannabits\FilamentModules\Concerns\ContextualPage;

class ListPosts extends ListRecords
{
    use ContextualPage;
    protected static string $resource = PostResource::class;
}
