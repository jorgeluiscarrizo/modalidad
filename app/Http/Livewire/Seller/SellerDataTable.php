<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;
use App\Models\Seller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SellerDataTable extends LivewireDatatable
{
     public $exportable = true;
    public $model = Seller::class;
    public $hideable = 'select';

    public function builder()
    {
        return Seller::query()->where('state', '!=', 'DELETED');
        //return Seller::query();
    }

    //Mostrar DataTables
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),

            Column::name('name')
                ->searchable()
                ->label('Nombre'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),

            DateColumn::name('created_at')
                ->label('Creado')
                ->format('d/m/Y h:i:s')
                ->filterable(),

                
            Column::callback(['id', 'slug', 'name',], function ($id, $slug, $name) {
                return view('livewire.seller.seller-table-actions', ['id' => $id, 'slug' => $slug, 'name' => $name]);
            })->label('Opciones')

        ];
    }

    public $idDelet;

    //Funcion para eliminar
    public function toastConfirmDelet($name, $id)
    {
        $this->idDelet =  $id;
        $this->confirm('¿Está seguro que desea eliminar el registro?', [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' => $name,
            'confirmButtonText' => 'Eliminar',
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

            $Seller = Seller::find($this->idDelet);
            //$Seller->delete();
            $Seller->state = "DELETED";
            $Seller->save();
            $this->alert('success', 'Registro eliminado correctamente', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'confirmButtonText' =>  'Ok',
            ]);
        }
    }
}
