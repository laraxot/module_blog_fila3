<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\PageResource;

class EditPage extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    use HasPagePreview;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // Actions\DeleteAction::make(),
        ];
    }
}
