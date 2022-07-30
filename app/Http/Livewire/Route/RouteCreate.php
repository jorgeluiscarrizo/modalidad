<?php

namespace App\Http\Livewire\Route;

use Livewire\Component;
use App\Models\Route;
use App\Models\City;
use App\Models\Goal;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class RouteCreate extends Component
{
    public $route;
    public $id_cities;
    public $id_goals;
    public $state = "ACTIVE";
    public $neighborhood;
    public $slug;
    public $routecities;
    public $routegoals;
  //generar slug
  public function generateSlug()
    {
        $this->slug = Str::slug(bcrypt(time()));
    }
    //recuperar ciudades y metas
    public function mount()
    {
        $this->routecities = City::all()->where('state', 'ACTIVE');  
        $this->routegoals = Goal::all()->where('state', 'ACTIVE'); 
    }
   
    //direccion del controlador
    public function render()
    {
        return view('livewire.route.route-create');
    }
    //reglas para validacion
    protected $rules = [
        //restriccion 
        'id_cities' => 'required',
        'id_goals' => 'required',
        'neighborhood' => 'required|max:255|min:3',
        'state' => 'required',
    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();
        //Creando registro route
        Route::create([
            'id_cities' => $this->id_cities,
            'id_goals' => $this->id_goals,
            'neighborhood' => $this->neighborhood,
            //encriptando slug
            'slug' => Str::slug(bcrypt(time())),
            'state' => $this->state,
        ]);
        $this->cleanInputs();
        $this->confirm('Registro creado correctamente', [
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' => false,
            'cancelButtonText' => 'Cancelar',
            'confirmButtonText' => 'Aceptar',
            'onConfirmed' => 'confirmed',
        ]);
    }

    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->id_cities = "";
        $this->id_goals = "";
        $this->neighborhood = "";     
    }
    //llamar ciudades
    public function onChangeSelectCity()
    {
 
        $this->routecities = City::all()->where('state', 'ACTIVE');
    }
    //llamar ciudades
    public function onChangeSelectGoal()
    {
    
        $this->routegoals = Goal::all()->where('state', 'ACTIVE');
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('route.dashboard');
    }
}
