<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\Client;
use App\Models\Type;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ClientCreate extends Component
{
    public $client;
    public $type_id;
    public $state = "ACTIVE";
    public $name;
    public $num_cell;
    public $slug;
    public $clienttypes;
    //
     
    //

  //generar slug
  public function generateSlug()
    {
        
        $this->slug = Str::slug(bcrypt(time()));
    }

    public function mount()
    {
        $this->clienttypes = Type::all()->where('state', 'ACTIVE');
    }
    public function render()
    {
        return view('livewire.client.client-create');
    }
    //reglas para validacion
    protected $rules = [
        //restriccion 
        'type_id' => 'required',
        'name' => 'required|max:255|min:3',
        'num_cell' => 'required|regex:/^([0-9\s-+()]*)$/|min:8|max:10',
        'state' => 'required',
    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();
        //Creando registro client
        Client::create([
            'type_id' => $this->type_id,
            'name' => $this->name,
            'num_cell' => $this->num_cell,
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
        $this->type_id = "";
        $this->name = "";
        $this->num_cell = "";
     
    }
    
    public function onChangeSelectType()
    {
 
        $this->clienttypes = Type::all()->where('state', 'ACTIVE');
    }

    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('client.dashboard');
    }
}
