<?php

namespace App\Http\Livewire\City;

use Livewire\Component;
use App\Models\City;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CityDataTable extends LivewireDatatable
{
    public $model = City::class;

    public function builder()
    {
        return City::query()->where('state', '!=', 'DELETED');
        
    }

    //Mostrar DataTables
    public function columns()
    {
        return [

            Column::name('name')
                ->searchable()
                ->label('Nombre Ciudad'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),

            Column::callback(['id', 'slug', 'name'], function ($id, $slug, $name) {
                return view('livewire.city.city-table-actions', ['id' => $id, 'slug' => $slug, 'name' => $name]);
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
            'text' =>  $name,
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

            $City = City::find($this->idDelet);
            //$City->delete();
            $City->state = "DELETED";
            $City->save();
            $this->alert('success', 'Registro eliminado correctamente', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'confirmButtonText' =>  'Ok',
            ]);
        }
    }
}
