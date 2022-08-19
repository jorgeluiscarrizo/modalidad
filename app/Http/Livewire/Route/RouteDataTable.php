<?php

namespace App\Http\Livewire\Route;

use Livewire\Component;
use App\Models\Route;
use App\Models\City;
use App\Models\Goal;
use App\Models\Seller;
use App\Models\Detailseller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RouteDataTable extends LivewireDatatable
{
    public $model = Route::class;
    
    public function builder()
    {
        return (Route::query()->where('routes.state', '!=', 'DELETED')
        ->join('cities', function ($join) {
            $join->on('cities.id', '=', 'routes.citi_id',);
        })
        ->join('goals', function ($join) {
            $join->on('goals.id', '=', 'routes.goal_id');
        }));         
    }
    public function columns()
    {
        return [

            Column::name('cities.name')
                ->searchable()
                ->label('Ciudad')
                ->alignRight(),

                Column::name('goals.amount')
                ->searchable()
                ->label('Meta')
                ->alignRight(),
                
            Column::name('neighborhood')
                ->searchable()
                ->label('Barrio'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),
 
            Column::callback(['id', 'neighborhood', 'slug'], function ($id, $neighborhood, $slug) {
                //dd($id);
                return view('livewire.route.route-table-actions', ['id' => $id, 'neighborhood' =>$neighborhood, 'slug' => $slug]);
            })->label('Opciones')
            ->excludeFromExport()
        ];
    }

    public $idDelet;
    
    public function toastConfirmDelet($id)
    {
        $this->idDelet = $id;
        $this->confirm(__('¿Estas seguro que seas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  'Código de Transacción '.$id,
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
            $Route = Route::find($this->idDelet);
            $Route->state = "DELETED";
            $Route->update();
        }
    }
}
