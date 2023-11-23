<?php

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Modules\Blog\Filament\Resources\TextWidgetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTextWidget extends ViewRecord
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
