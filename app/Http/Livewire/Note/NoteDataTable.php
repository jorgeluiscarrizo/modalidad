<?php

namespace App\Http\Livewire\Note;

use App\Models\Note;
use App\Models\Productnote;
use App\Models\Batch;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
class NoteDataTable extends Component
{
    public $exportable = true;
    public $model = Note::class;
    public $productnotes;
    public $batch;
    public $hideable = 'select';
    //public $complex = true;

    public function builder()
    {
        //return Note::query();
        return Note::query()->where('state', '!=', 'DELETED');
    }

    public function columns()
    {
        return [
            Column::name('id')
                ->searchable()
                ->label('Codigo'),

            Column::name('total')
                ->searchable()
                ->label('Total'),

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

            Column::callback(['id', 'slug'], function ($id, $slug) {
                return view('livewire.sale.sale-table-actions', ['id' => $id, 'slug' => $slug]);
                })->label('Opciones')
                ->excludeFromExport()

        ];
    }
    public function cancelsale($id){
        $this->productnotes = Productnote::all()->where('id_notes', $id);
        foreach ($this->productnotes as $id_ => $item) {
            
            $this->batch = Batch::where('id', $item['id_batches'])->firstOrFail();
            $this->batch->update([
                'stock' =>  $this->batch->stock + $item['quantity'],
            ]);
        }
    }
    public $idDelet;
    public function toastConfirmDelet($id)
    {
        $this->idDelet = $id;
        $this->confirm(__('¿Estas seguro que seas anular el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
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
            $Note = Note::find($this->idDelet);
            $this->cancelsale($this->idDelet);
            $Note->state = "DELETED";
            $Note->update();
        }
    }
}
