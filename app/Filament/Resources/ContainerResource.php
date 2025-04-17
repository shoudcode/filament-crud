<?php

namespace App\Filament\Resources;

use Date;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Container;
use Filament\Tables\Table;
use PhpParser\Node\Stmt\Label;
use Filament\Resources\Resource;
use Tables\Actions\DeleteAction;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\ContainerExporter;
use App\Filament\Imports\ContainerImporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Resources\ContainerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContainerResource\RelationManagers;

class ContainerResource extends Resource
{
    protected static ?string $model = Container::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('kapal')->required(),
                        DatePicker::make('etd')
                            ->required()
                            ->placeholder('Tanggal ETD')
                            ->displayFormat('d/m/Y'),
                        DatePicker::make('eta')
                        ->required()
                        ->placeholder('Tanggal ETD')
                        ->displayFormat('d/m/Y'),
                        TextInput::make('shipper'),
                        TextInput::make('penerima'),
                        TextInput::make('no_container')->required(),
                        Select::make('ukuran')
                            ->options([
                                '20' => '20 Feet',
                                '40' => '40 Feet',
                            ])
                            ->required(),
                            TextInput::make('lokasi_bongkar'),
                            DatePicker::make('tgl_muat')
                            ->required()
                            ->placeholder('Tanggal Muat')
                            ->displayFormat('d/m/Y'),
                            DatePicker::make('tgl_bongkar')
                            ->required()
                            ->placeholder('Tanggal Bongkar')
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kapal')
                    ->label('Nama Kapal')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('etd')
                    ->label('ETD')
                    ->sortable()
                    ->date('d/m/Y'),
                    TextColumn::make('eta')
                    ->label('ETA')
                    ->sortable()
                    ->date('d/m/Y'),
                TextColumn::make('shipper')
                    ->label('Shipper')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('penerima')
                    ->label('Penerima')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('no_container')
                    ->label('No Container')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('ukuran')
                    ->label('Ukuran')
                    ->sortable(),
                    TextColumn::make('lokasi_bongkar')
                    ->label('Lokasi Bongkar')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tgl_muat')
                    ->label('Tanggal Muat')
                    ->sortable()
                    ->date('d/m/Y'),
                TextColumn::make('tgl_bongkar')
                    ->label('Tanggal Bongkar')
                    ->sortable()
                    ->date('d/m/Y'),
            ])
            ->filters([
                SelectFilter::make('kapal')
                    ->label('Pilh Kapal')
                    ->multiple()
                    ->preload()
                    ->options([
                        Container::query()
                        ->select('kapal')
                        ->distinct()
                        ->pluck('kapal','kapal')
                        ->toArray()
                    ]),
                    SelectFilter::make('shipper')
                    ->label('Pilh Shipper')
                    ->multiple()
                    ->preload()
                    ->options([
                        Container::query()
                        ->select('shipper')
                        ->distinct()
                        ->pluck('shipper','shipper')
                        ->toArray()
                    ]),
                    SelectFilter::make('penerima')
                    ->label('Pilh Penerima')
                    ->multiple()
                    ->preload()
                    ->options([
                        Container::query()
                        ->select('penerima')
                        ->distinct()
                        ->pluck('penerima','penerima')
                        ->toArray()
                    ]),
                    SelectFilter::make('ukuran')
                    ->label('Pilh Ukuran')
                    ->multiple()
                    ->preload()
                    ->options([
                        Container::query()
                        ->select('ukuran')
                        ->distinct()
                        ->pluck('ukuran','ukuran')
                        ->toArray()
                    ]),
                    SelectFilter::make('lokasi_bongkar')
                    ->label('Pilh Lokasi Bongkar')
                    ->multiple()
                    ->preload()
                    ->options([
                        Container::query()
                        ->select('lokasi_bongkar')
                        ->distinct()
                        ->pluck('lokasi_bongkar','lokasi_bongkar')
                        ->toArray()
                    ]),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->Exporter(ContainerExporter::class),

                ]),
                ])
                ->headerActions([
                ExportAction::make()
                    ->Exporter(ContainerExporter::class),
                ImportAction::make()
                ->importer(ContainerImporter::class),
                ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContainers::route('/'),
            'create' => Pages\CreateContainer::route('/create'),
            'edit' => Pages\EditContainer::route('/{record}/edit'),
        ];
    }
}
