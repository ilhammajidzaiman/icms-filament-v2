<?php

namespace App\Filament\Resources\BlogArticleResource\Pages;

use App\Models\BlogArticle;
use Filament\Pages\Actions;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BlogArticleResource;

class EditBlogArticle extends EditRecord
{
    protected static string $resource = BlogArticleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make()
            //     ->after(function (BlogArticle $record) {
            //         // delete single
            //         if ($record->file) {
            //             Storage::disk('public')->delete($record->file);
            //         }
            //     }),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
