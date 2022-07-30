<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class UserUpdate extends Component
{
    public $user;
    public $name;
    public $email;
    public $password;
    public $state;
    //public $id;
    //Rol
    public $role;
    public $roles;
    public $role_id;

    public function mount($id)
    {
      
        $this->user = User::where('id', $id)->firstOrFail();
        $this->roles = Role::all();
        if ($this->user) {
            //cargando datos del usuario
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->state = $this->user->state;

            //Verificando rol
            $this->role_id = $this->user->roles->first()->id;
            $this->role = $this->user->roles->first()->id;
        }

    }
    public function render()
    {
        return view('livewire.user.user-update');
    }
    protected $rules = [
//restriccion user
        'name' => 'required|max:255|min:2',
        'email' => 'unique:users|email',
        'password' => 'nullable',
        'state' => 'required',

    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
       // $this->rules['slug'] = 'required|unique:users,slug,' . $this->user->id;
        $this->rules['email'] = 'required|unique:users,email,' . $this->user->id;
        $this->validate();
        if((int)$this->role_id <> $this->role){
            //Editando rol
            $this->user->roles()->detach($this->role);
            $this->user->roles()->attach($this->role_id);
        }
        if($this->password) {
            //Actualizando registro
            $this->user->update([
                'email' => $this->email,
                'name' => $this->name,
                'password' => bcrypt($this->password),
                'state' => $this->state,
            ]);
        } else {
            //Actualizando registro
            $this->user->update([
                'email' => $this->email,
                'name' => $this->name,
                'state' => $this->state,
            ]);
        }
            
        //Mensaje de registro
        $this->confirm('Registro exitoso', [
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' =>  'Ok',
            'showConfirmButton' => true,
            'showCancelButton' => false,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
    }
    public function onChangeSelectRole()
    {
        $this->roles = Role::all();
    }
   //Escuchadores para botones de alertas
   protected $listeners = [
    'confirmed',
];

//Funcion que llama la alerta para redigir al dashboar
public function confirmed()
{
    return redirect()->route('user.dashboard');
}
}
