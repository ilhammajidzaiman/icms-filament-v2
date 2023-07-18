<?php

namespace App\Filament\Resources\BlogTagResource\Pages;

use App\Filament\Resources\BlogTagResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogTag extends CreateRecord
{
    protected static string $resource = BlogTagResource::class;
    protected static ?string $label = 'Tag';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
