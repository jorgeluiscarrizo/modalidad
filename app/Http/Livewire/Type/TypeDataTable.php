<?php

namespace App\Http\Livewire\Type;

use Livewire\Component;
use App\Models\Type;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class TypeDataTable extends LivewireDatatable
{
    public $model = Type::class;
    public function builder()
    {
        
        return Type::query()->where('state', '!=', 'DELETED');
        //return Type::query();
    }

    //Mostrar DataTables
    public function columns()
    {
        return [

            Column::name('name')
                ->searchable()
                ->label('Tipo de Cliente'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),
                
            Column::callback(['id', 'slug', 'name'], function ($id, $slug, $name) {
                return view('livewire.type.type-table-actions', ['id' => $id, 'slug' => $slug, 'name' => $name]);
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

            $Type = Type::find($this->idDelet);
            //$Type->delete();
            $Type->state = "DELETED";
            $Type->save();
            $this->alert('success', 'Registro eliminado correctamente', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'confirmButtonText' =>  'Ok',
            ]);
        }
    }
}
