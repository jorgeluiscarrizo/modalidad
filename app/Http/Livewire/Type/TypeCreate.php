<?php

namespace App\Http\Livewire\Type;

use Livewire\Component;
use App\Models\Type;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;


class TypeCreate extends Component
{
    use WithFileUploads;

    public $type;
    public $name;
    public $slug;
    public $state = 'ACTIVE';

    //Funcion para generar Slug para la URL
    public function generateSlug()
    {
        $this->slug = Str::slug(bcrypt(time()));
    }

    //Reglas para validar
    protected $rules = [
        'name' => 'required|max:255|min:3',
        'state' => 'required',
    ];
    
    //Funcion para registrar el type 
    public function submit()
    {
        
        $this->validate();
        $this->type = Type::create([
            'name' => $this->name,
            'slug' => Str::slug(bcrypt(time())),
            'state' => $this->state,
        ]);

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
    public function CleanInputs()
    {
        $this->name = " ";
    }

    protected $listeners = [
        'confirmed',
    ];

    public function confirmed()
    {
        return redirect()->route('type.dashboard');
    }
    
    //Funcion para devolver vista
    public function render()
    {
        return view('livewire.type.type-create');
    }
}
