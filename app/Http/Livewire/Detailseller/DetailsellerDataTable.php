<?php

namespace App\Http\Livewire\Detailseller;

use Livewire\Component;
use App\Models\Detailseller;
use App\Models\Route;
use App\Models\Seller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DetailsellerDataTable extends LivewireDatatable
{
    public $model = Detailseller::class;
    
    public function builder()
    {
        return (Detailseller::query()->where('detailsellers.state', '!=', 'DELETED')
        ->join('sellers', function ($join) {
            $join->on('sellers.id', '=', 'detailsellers.seller_id',);
        })
        ->join('routes', function ($join) {
            $join->on('routes.id', '=', 'detailsellers.route_id');
        })
    );        
    }
    public function columns( )
    {
        return [

                Column::name('routes.neighborhood')
                ->searchable()
                ->label('Barrio')
                ->alignRight(),

                Column::name('sellers.name')
                ->searchable()
                ->label('nombre')
                ->alignRight(),

                Column::name('date_i')
                ->searchable()
                ->label('Fecha Inicio'),

                Column::name('date_f')
                ->searchable()
                ->label('Fecha final'),
                Column::callback(['state'], function ($state) {
                    return view('components.datatables.state-data-table', ['state' => $state]);
                })

                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),

                Column::callback(['id', 'slug'], function ($id, $slug) {
                    //dd($id);
                    return view('livewire.detailseller.detailseller-table-actions', ['id' => $id, 'slug' => $slug]);
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
            $Detailseller = Detailseller::find($this->idDelet);
            $Detailseller->state = "DELETED";
            $Detailseller->update();
        }
    }
}
