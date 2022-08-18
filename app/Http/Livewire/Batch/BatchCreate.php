<?php

namespace App\Http\Livewire\Batch;

use Livewire\Component;
use App\Models\Batch;
use App\Models\Product;
use Illuminate\Support\Str;

class BatchCreate extends Component
{
    public $batch;
    public $product_id;
    public $name;
    public $price;
    public $stock;
    public $slug;
    public $state = 'ACTIVE';
    public $warehouses;
    public $products;
    public function mount()
    {
        $this->products = Product::all()->where('state', 'ACTIVE');
    }
    public function render()
    {
        return view('livewire.batch.batch-create');
    }
    //reglas para validacion
    protected $rules = [
        'product_id' => 'required',
        'name' => 'required|max:20|min:2|unique:batches,name',
        'price' => 'required',
        'stock' => 'required',
        'state' => 'required',
    ];
    //Metodo que llama el formulario
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->validate();
        //Creando registro person
        
        $this->batch = Batch::create([
            'product_id' => $this->product_id,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
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
        $this->product_id = "";
        $this->name = "";
        $this->price = "";
        $this->stock = "";
        $this->state = "";
    }

    public function onChangeSelectProduct()
    {
        $this->products = Product::all()->where('state', 'ACTIVE');
    }

    public function selectedCustomer($id)
    {
        $this->product = Product::with('product')->find($id);
        $this->product_id = $id;
    }
    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
        'selectedCustomer' => 'selectedCustomer'
    ];

    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('batch.dashboard');
    }
}

