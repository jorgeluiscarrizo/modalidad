<?php

namespace App\Http\Livewire\City;

use Livewire\Component;
use App\Models\City;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CityCreate extends Component
{
    use WithFileUploads;

    public $city;
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
    
    //Funcion para registrar el city 
    public function submit()
    {
        $this->validate();
        $this->city = City::create([
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
        return redirect()->route('city.dashboard');
    }
    
    //Funcion para devolver vista
    public function render()
    {
        return view('livewire.city.city-create');
    }
}
