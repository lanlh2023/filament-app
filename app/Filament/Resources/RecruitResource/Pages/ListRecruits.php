<?php

namespace App\Filament\Resources\RecruitResource\Pages;

use App\Filament\Export\RecruitExport;
use App\Filament\Resources\RecruitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecruits extends ListRecords
{
    protected static string $resource = RecruitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->exporter(RecruitExport::class),
            Actions\CreateAction::make(),
        ];
    }
}
