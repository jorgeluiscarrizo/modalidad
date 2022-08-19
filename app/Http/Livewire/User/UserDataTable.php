<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserDataTable extends LivewireDatatable
{
    public $model = User::class;

    public function builder()
    {

        return User::query()
            ->where('state', '!=', 'DELETED')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id');
    }

    public function columns()
    {
        return [
            
            Column::name('name')
                ->searchable()
                ->label('Nombre'),

            Column::name('roles.name')
                ->label('roles'),

            Column::name('email')
                ->searchable()
                ->label('Correo'),

            Column::callback(['state'], function ($state) {
                return view('components.datatables.state-data-table', ['state' => $state]);
            })
                ->label('Estado')
                ->filterable([
                    'ACTIVE',
                    'INACTIVE'
                ]),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('livewire.user.user-table-actions', ['id' => $id, 'name' => $name]);
            })->label(__('labeltables.actions'))

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
            'text' =>  'Usuario ' . $name,
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
            $User = User::find($this->idDelet);
            $User->state = "DELETED";
            $User->update();
        }
    }
}
