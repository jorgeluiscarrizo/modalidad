<?php


namespace App\Http\Livewire\NoteCancelled;

use App\Models\Note;
use App\Models\NoteDetail;
use App\Models\Batch;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class NoteCancelledDataTable extends LivewireDatatable
{
    public $model = Note::class;
    public $notedetails;
    public $batch;
    public $hideable = 'select';

    public function builder()
    {
        return Note::query()
            ->join('sellers', function ($join) {
                $join->on('sellers.id', '=', 'notes.seller_id',);
            })
            ->join('clients', function ($join) {
                $join->on('clients.id', '=', 'notes.client_id');
            })->where('notes.state', 'DELETED');
    }

    public function columns()
    {
        return [

            Column::name('sellers.name')
                ->searchable()
                ->label('Vendedor'),

            Column::name('clients.name')
                ->searchable()
                ->label('Cliente'),

            Column::name('total')
                ->searchable()
                ->label('Total'),
            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado'),
            DateColumn::name('created_at')
                ->label('Creado')
                ->format('d/m/Y h:i:s')
                ->filterable(),

            Column::callback(['id', 'slug'], function ($id, $slug) {
                return view('livewire.note-cancelled.note-cancelled-table-actions', ['id' => $id, 'slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()

        ];
    }
}
