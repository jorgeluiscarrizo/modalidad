<?php

namespace App\Http\Livewire\Goal;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class GoalDataTable extends LivewireDatatable
{
    public $exportable = true;
    public $model = Goal::class;
    public $hideable = 'select';

    public function builder()
    {
        return Goal::query()->where('state', '!=', 'DELETED');
        
    }

    //Mostrar DataTables
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),

                Column::name('date_i')
                ->searchable()
                ->label('Fecha inicio'),

                Column::name('date_f')
                ->searchable()
                ->label('Fecha fin'),

                Column::name('amount')
                ->searchable()
                ->label('Meta'),

                Column::name('bonus')
                ->searchable()
                ->label('Bono'),

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

            Column::callback(['id', 'slug', 'amount'], function ($id, $slug, $amount) {
                return view('livewire.goal.goal-table-actions', ['id' => $id, 'slug' => $slug, 'amount' => $amount]);
            })->label('Opciones')

        ];
    }
    public $idDelet;
    //Funcion para eliminar
    public function toastConfirmDelet($amount,$id)
    {
        $this->idDelet =  $id;
        $this->confirm('¿Está seguro que desea eliminar el registro?', [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'number' =>  $amount,
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

            $Goal = Goal::find($this->idDelet);
            //$Goal->delete();
            $Goal->state = "DELETED";
            $Goal->save();
            $this->alert('success', 'Registro eliminado correctamente', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'confirmButtonText' =>  'Ok',
            ]);
        }
    }
}
