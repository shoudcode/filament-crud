<?php

namespace App\Filament\Imports;

use App\Models\Container;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ContainerImporter extends Importer
{
    protected static ?string $model = Container::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('kapal')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('etd')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('eta')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('shipper')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('penerima')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('no_container')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('ukuran')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('lokasi_bongkar')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('tgl_muat')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('tgl_bongkar')
                ->requiredMapping()
                ->rules(['required', 'date']),
        ];
    }

    public function resolveRecord(): ?Container
    {
        // return Container::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Container();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your container import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
