<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\Client;
use App\Models\Type;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ClientUpdate extends Component
{
    public $client;
    public $id_type;
    public $name;
    public $num_cell;
    public $slug;
    public $state;
    public $clienttypes;

    public function mount($slug)
    {

        $this->client = Client::where('slug', $slug)->firstOrFail();

        if ($this->client) {
            //cargando datos de la client
            $this->id_type = $this->client->id_type;
            $this->name = $this->client->name;
            $this->num_cell = $this->client->num_cell;
            $this->slug = $this->client->slug;
            $this->state = $this->client->state;
        }
        $this->clienttypes = Type::all()->where('state', 'ACTIVE');
    }
    public function render()
    {
        return view('livewire.client.client-update');
    }
    protected $rules = [
        //restriccion client
        'id_type' => 'nullable',
        'name' => 'required|max:255|min:3',
        'num_cell' => 'required|max:255|min:3',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['slug'] = 'required|unique:clients,slug,' . $this->client->id;
        $this->validate();
        
        //Actualizando registro
        $this->client->update([

            'id_type' => $this->id_type,
            'name' => $this->name,
            'num_cell' => $this->num_cell,
            'slug' =>  Str::slug(bcrypt(time())),
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
        return redirect()->route('client.dashboard');
    }

    public function generateSlug()
    {
            $this->slug =  Str::slug(bcrypt(time()));      
    }
    public function onChangeSelectType()
    {
        $this->clienttypes = Type::all()->where('state', 'ACTIVE');
    }
}
