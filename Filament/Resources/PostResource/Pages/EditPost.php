<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\PostResource;
use Savannabits\FilamentModules\Concerns\ContextualPage;

class EditPost extends EditRecord
{
    use ContextualPage;
    protected static string $resource = PostResource::class;
}
