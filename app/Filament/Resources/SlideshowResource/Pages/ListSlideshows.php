<?php

namespace App\Filament\Resources\SlideshowResource\Pages;

use App\Filament\Resources\SlideshowResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListSlideshows extends ListRecords
{
    protected static string $resource = SlideshowResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]),
        ];
    }
}
