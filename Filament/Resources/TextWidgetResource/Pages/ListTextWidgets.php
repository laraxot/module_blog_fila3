<?php

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Modules\Blog\Filament\Resources\TextWidgetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTextWidgets extends ListRecords
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
