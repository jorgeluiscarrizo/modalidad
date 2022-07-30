<?php

namespace App\Http\Livewire\Detailseller;

use Livewire\Component;
use App\Models\Route;
use App\Models\Seller;
use App\Models\Detailseller;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class DetailsellerUpdate extends Component
{
    public $detailseller;
    public $id_sellers;
    public $id_routes;
    public $state;
    public $date_i;
    public $date_f;
    public $slug;
    public $detailsell;
    public $detailroute;

    public function mount($slug)
    {

        $this->detailseller = Detailseller::where('slug', $slug)->firstOrFail();

        if ($this->detailseller) {
            //cargando datos de la detailseller
            $this->id_sellers = $this->detailseller->id_sellers;
            $this->id_routes = $this->detailseller->id_routes;
            $this->date_i = $this->detailseller->date_i;
            $this->date_f = $this->detailseller->date_f;
            $this->slug = $this->detailseller->slug;
            $this->state = $this->detailseller->state;
        }
        $this->detailsell = Seller::all()->where('state', 'ACTIVE');
        $this->detailroute = Route::all()->where('state', 'ACTIVE');
    }
    public function render()
    {
        return view('livewire.detailseller.detailseller-update');
    }
    protected $rules = [
        //restriccion detailseller
        'id_sellers' => 'nullable',
        'id_routes' => 'nullable',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['slug'] = 'required|unique:detailsellers,slug,' . $this->detailseller->id;
        $this->validate();
        
        //Actualizando registro
        $this->detailseller->update([

            'id_sellers' => $this->id_sellers,
            'id_routes' => $this->id_routes,
            'date_i' => $this->date_i,
            'date_f' => $this->date_f,
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
    }
    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        return redirect()->route('detailseller.dashboard');
    }

    public function generateSlug()
    {
            $this->slug = Str::slug(bcrypt(time()));
    }
    public function onChangeSelectSeller()
    {
        $this->detailsell = Seller::all()->where('state', 'ACTIVE');
    }
    public function onChangeSelectRoute()
    {
        $this->detailroute = Route::all()->where('state', 'ACTIVE');
    }
}
