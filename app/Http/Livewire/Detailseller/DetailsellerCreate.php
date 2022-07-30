<?php

namespace App\Http\Livewire\Detailseller;

use Livewire\Component;
use App\Models\Route;
use App\Models\Seller;
use App\Models\Detailseller;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class DetailsellerCreate extends Component
{
    public $detailseller;
    public $id_sellers;
    public $id_routes;
    public $state = "ACTIVE";
    public $date_i;
    public $date_f;
    public $slug;
    public $detailsell;
    public $detailroute;
  //generar slug
  public function generateSlug()
    {
        $this->slug = Str::slug(bcrypt(time()));
    }
    //recuperar ciudades y metas
    public function mount()
    {
        $this->detailsell = Seller::all()->where('state', 'ACTIVE');  
        $this->detailroute = Route::all()->where('state', 'ACTIVE'); 
    }
   
    //direccion del controlador
    public function render()
    {
        return view('livewire.detailseller.detailseller-create');
    }
    //reglas para validacion
    protected $rules = [
        //restriccion 
        'id_sellers' => 'required',
        'id_routes' => 'required',
        'date_i' => 'required',
        'date_f' => 'required',
        'state' => 'required',
    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();
        //Creando registro detailseller
        Detailseller::create([
            'id_sellers' => $this->id_sellers,
            'id_routes' => $this->id_routes,
            'date_i' => $this->date_i,
            'date_f' => $this->date_f,
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
        $this->id_sellers = "";
        $this->id_routes = "";
        $this->date_i = "";
        $this->date_f = "";  
    }
    //llamar ciudades
    public function onChangeSelectSeller()
    {
 
        $this->detailsell = Seller::all()->where('state', 'ACTIVE');
    }
    //llamar ciudades
    public function onChangeSelectRoute()
    {
    
        $this->detailroute = Route::all()->where('state', 'ACTIVE');
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('detailseller.dashboard');
    }
}
