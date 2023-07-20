<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Modules\Blog\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Savannabits\FilamentModules\Concerns\ContextualPage;
use Filament\Pages\Actions;

class CreatePost extends CreateRecord
{
    use ContextualPage;
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
