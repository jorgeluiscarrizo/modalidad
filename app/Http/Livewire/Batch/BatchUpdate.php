<?php

namespace App\Http\Livewire\Batch;

use Livewire\Component;
use App\Models\Batch;
use App\Models\Product;
use App\Models\Supplier;


class BatchUpdate extends Component
{
    //batch
    public $batch;
    public $product_id;
    public $name;
    public $price;
    public $stock;
    public $slug;
    public $state;
    public $products;

    public function mount($slug)
    {

        $this->batch = Batch::where('slug', $slug)->firstOrFail();

        if ($this->batch) {
            //cargando datos de la batch
            $this->product_id = $this->batch->product_id;
            $this->name = $this->batch->name;
            $this->price = $this->batch->price;
            $this->stock = $this->batch->stock;
            $this->state = $this->batch->state;
        }
        $this->products = Product::all()->where('state', 'ACTIVE');
    }
    public function render()
    {
        return view('livewire.batch.batch-update');
    }
    protected $rules = [
        //restriccion batch
        'product_id' => 'required',
        'name' => 'required|max:20|min:2|unique:batches,name',
        'price' => 'required',
        'stock' => 'required',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['name'] = 'required|unique:batches,slug,' . $this->batch->id;
        $this->validate();
        
        //Actualizando registro
        $this->batch->update([
            'product_id' => $this->product_id,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
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
        return redirect()->route('batch.dashboard');
    }
    public function onChangeSelectProduct()
    {
        $this->products = Product::all()->where('state', 'ACTIVE');
    }
}
