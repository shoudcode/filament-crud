<?php

namespace App\Filament\Exports;

use App\Models\Container;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ContainerExporter extends Exporter
{
    protected static ?string $model = Container::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('kapal'),
            ExportColumn::make('etd'),
            ExportColumn::make('eta'),
            ExportColumn::make('shipper'),
            ExportColumn::make('penerima'),
            ExportColumn::make('no_container'),
            ExportColumn::make('ukuran'),
            ExportColumn::make('lokasi_bongkar'),
            ExportColumn::make('tgl_muat'),
            ExportColumn::make('tgl_bongkar'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your container export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
