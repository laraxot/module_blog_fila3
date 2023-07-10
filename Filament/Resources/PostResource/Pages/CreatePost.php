<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Modules\Blog\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Savannabits\FilamentModules\Concerns\ContextualPage;

class CreatePost extends CreateRecord
{
    use ContextualPage;
    protected static string $resource = PostResource::class;
}
