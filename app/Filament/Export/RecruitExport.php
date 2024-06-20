<?php

namespace App\Filament\Export;

use App\Models\Recruit;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class RecruitExport extends Exporter
{
    protected static ?string $model = Recruit::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),
            ExportColumn::make('title'),
            ExportColumn::make('description'),
            ExportColumn::make('company.name'),
            ExportColumn::make('prefecture.name'),
            ExportColumn::make('start_date'),
            ExportColumn::make('end_date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your Recruit export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
