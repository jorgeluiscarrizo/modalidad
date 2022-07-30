<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $state = 'ACTIVE';
    //Rol
    public $roles;
    public $role_id;

    public function mount()
    {
        $this->roles = Role::all();
        
    }
    public function render()
    {
        return view('livewire.user.user-create');
    }
    protected $rules = [
        //restriccion user
        'name' => 'required|max:255|min:2',
        'email' => 'unique:users|email',
        'password' => 'nullable',
        'state' => 'required',
        


    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();
            //Creando registro usuario
            $User = User::create([
                'email' => $this->email,
                'name' => $this->name,
                'email_verified_at' => now(),
                'password' => bcrypt($this->password),
                'remember_token' => Str::random(10),
                //encriptando slug
                'slug' => Str::slug(bcrypt(time())),
                'state' => $this->state,
            ]);
            //Creando registro de asignacion de Rol
            $Rol = Role::find($this->role_id);
            if ($Rol) {
                $User->roles()->attach($Rol);
            }
        $this->cleanInputs();

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
    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->name = "";
        $this->email = "";
        $this->password = "";
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

