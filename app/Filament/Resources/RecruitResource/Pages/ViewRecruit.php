<?php

namespace App\Filament\Resources\RecruitResource\Pages;

use App\Filament\Resources\RecruitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRecruit extends ViewRecord
{
    protected static string $resource = RecruitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
