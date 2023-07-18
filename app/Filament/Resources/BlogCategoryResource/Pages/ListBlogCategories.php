<?php

namespace App\Filament\Resources\BlogCategoryResource\Pages;

use App\Filament\Resources\BlogCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListBlogCategories extends ListRecords
{
    protected static string $resource = BlogCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Baru'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make()->label('okeeee'),
            Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make()->label('okeeee'),
                Tables\Actions\DeleteAction::make()->label('okeeee'),
            ]),
        ];
    }
}
