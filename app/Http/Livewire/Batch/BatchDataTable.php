<?php

namespace App\Http\Livewire\Batch;

use App\Models\Batch;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BatchDataTable extends LivewireDatatable
{
    public $model = Batch::class;

    public function builder()
    {
        //return Batch::query();
        return (Batch::query()->where('batches.state', '!=', 'DELETED')
        ->join('products', function ($join) {
            $join->on('products.id', '=', 'batches.product_id');
        }));    
    }

    public function columns()
    {
        return [
            Column::name('name')
                ->searchable()
                ->label('Nombre'),
                
            Column::name('products.name')
                ->searchable()
                ->label('Producto'),

                Column::name('price')
                ->searchable()
                ->label('Precio'),

                Column::name('stock')
                ->searchable()
                ->label('Cantidad'),

            Column::name('products.description')
                ->searchable()
                ->label('Descripción'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),

            Column::callback(['id', 'slug', 'name'], function ($id, $slug, $name) {
                return view('livewire.batch.batch-table-actions', ['id' => $id, 'slug' => $slug, 'name' => $name]);
            })->label('Opciones')
                ->excludeFromExport()
        ];
    }

    public $idDelet;
    public function toastConfirmDelet($name, $id)
    {
        $this->idDelet = $id;
        $this->confirm(__('¿Estas seguro que seas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  $name,
            'confirmButtonText' =>  'Si',
            'showConfirmButton' =>  true,
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
    }

    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        if ($this->idDelet) {
            $Batch = Batch::find($this->idDelet);
            $Batch->state = "DELETED";
            $Batch->update();
            //$Batch->delete();
        }
    }
}
