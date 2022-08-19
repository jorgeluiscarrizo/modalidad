<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\Type;
use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

 
 
class ClientDataTable extends LivewireDatatable
{
    public $model = Client::class;
    public function builder()
    {       
        return Client::query()
            ->where('clients.state', '!=', 'DELETED')
            ->join('types', 'types.id', '=', 'clients.type_id');
    }
    
    public function columns()
    { 
        return [

            Column::name('types.name')
                ->searchable()
                ->label('Tipo de cliente')
                ->alignRight(),
                
            Column::name('name')
                ->searchable()
                ->label('Nombre'),

            Column::name('num_cell')
                ->searchable()
                ->label('Numero Celular'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),
 
            Column::callback(['id', 'name', 'slug'], function ($id, $name, $slug) {
                //dd($id);
                return view('livewire.client.client-table-actions', ['id' => $id, 'name' =>$name, 'slug' => $slug]);
            })->label('Opciones')
            ->excludeFromExport()
        ];
    }
    public $idDelet;
    public function toastConfirmDelet($name, $id )
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
            $Client = Client::find($this->idDelet);
            $Client->state = "DELETED";
            $Client->update();
        
        }
    }
}
