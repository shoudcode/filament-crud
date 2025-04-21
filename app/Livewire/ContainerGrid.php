<?php

namespace App\Livewire;

use App\Models\Container;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ContainerGrid extends PowerGridComponent
{
    public string $tableName = 'container-grid-ctudvm-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Container::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('kapal')

           /** Example of custom column using a closure **/
            ->add('kapal_lower', fn (Container $model) => strtolower(e($model->kapal)))

            ->add('etd_formatted', fn (Container $model) => Carbon::parse($model->etd)->format('d/m/Y'))
            ->add('eta_formatted', fn (Container $model) => Carbon::parse($model->eta)->format('d/m/Y'))
            ->add('shipper')
            ->add('penerima')
            ->add('no_container')
            ->add('ukuran')
            ->add('lokasi_bongkar')
            ->add('tgl_muat_formatted', fn (Container $model) => Carbon::parse($model->tgl_muat)->format('d/m/Y'))
            ->add('tgl_bongkar_formatted', fn (Container $model) => Carbon::parse($model->tgl_bongkar)->format('d/m/Y'))
            ->add('created_at_formatted', fn (Container $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Kapal', 'kapal')
                ->sortable()
                ->searchable(),

            Column::make('Etd', 'etd_formatted', 'etd')
                ->sortable(),

            Column::make('Eta', 'eta_formatted', 'eta')
                ->sortable(),

            Column::make('Shipper', 'shipper')
                ->sortable()
                ->searchable(),

            Column::make('Penerima', 'penerima')
                ->sortable()
                ->searchable(),

            Column::make('No container', 'no_container')
                ->sortable()
                ->searchable(),

            Column::make('Ukuran', 'ukuran')
                ->sortable()
                ->searchable(),

            Column::make('Lokasi bongkar', 'lokasi_bongkar')
                ->sortable()
                ->searchable(),

            Column::make('Tgl muat', 'tgl_muat_formatted', 'tgl_muat')
                ->sortable(),

            Column::make('Tgl bongkar', 'tgl_bongkar_formatted', 'tgl_bongkar')
                ->sortable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('kapal')->operators(['contains']),
            Filter::datepicker('etd'),
            Filter::datepicker('eta'),
            Filter::inputText('shipper')->operators(['contains']),
            Filter::inputText('penerima')->operators(['contains']),
            Filter::inputText('no_container')->operators(['contains']),
            Filter::inputText('ukuran')->operators(['contains']),
            Filter::inputText('lokasi_bongkar')->operators(['contains']),
            Filter::datepicker('tgl_muat'),
            Filter::datepicker('tgl_bongkar'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Container $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
