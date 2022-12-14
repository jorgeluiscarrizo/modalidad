<?php

namespace App\Http\Livewire\Route;

use Livewire\Component;
use App\Models\Route;
use App\Models\City;
use App\Models\Goal;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class RouteUpdate extends Component
{
    public $route;
    public $citi_id;
    public $goal_id;
    public $state;
    public $neighborhood;
    public $slug;
    public $routecities;
    public $routegoals;

    public function mount($slug)
    {

        $this->route = Route::where('slug', $slug)->firstOrFail();

        if ($this->route) {
            //cargando datos de la route
            $this->citi_id = $this->route->citi_id;
            $this->goal_id = $this->route->goal_id;
            $this->neighborhood = $this->route->neighborhood;
            $this->slug = $this->route->slug;
            $this->state = $this->route->state;
        }
        $this->routecities = City::all()->where('state', 'ACTIVE');
        $this->routegoals = Goal::all()->where('state', 'ACTIVE');
    }
    public function render()
    {
        return view('livewire.route.route-update');
    }
    protected $rules = [
        //restriccion route
        'citi_id' => 'nullable',
        'goal_id' => 'nullable',
        'neighborhood' => 'required|max:255|min:3',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['slug'] = 'required|unique:routes,slug,' . $this->route->id;
        $this->validate();
        
        //Actualizando registro
        $this->route->update([

            'citi_id' => $this->citi_id,
            'goal_id' => $this->goal_id,
            'neighborhood' => $this->neighborhood,
            'slug' => Str::slug(bcrypt(time())),
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->confirm('Registro editado correctamente', [
            'icon' => 'success',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' =>  'Ok',
            'showConfirmButton' => true,
            'showCancelButton' => false,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
        /*
        $this->alert('success', 'Registro editado correctamente.', [
            'position' => 'center',
            'toast' => true,
           ]);
           */
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        return redirect()->route('route.dashboard');
    }

    public function generateSlug()
    {
            $this->slug = Str::slug(bcrypt(time()));   
    }
    public function onChangeSelectCity()
    {
        $this->routecities = City::all()->where('state', 'ACTIVE');
    }
    public function onChangeSelectGoal()
    {
        $this->routegoals = Goal::all()->where('state', 'ACTIVE');
    }
}
