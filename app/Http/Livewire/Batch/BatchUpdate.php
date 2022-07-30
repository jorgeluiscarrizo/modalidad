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
    public $id_products;
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
            $this->id_products = $this->batch->id_products;
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
        'id_products' => 'required',
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
            'id_products' => $this->id_products,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'state' => $this->state,            
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',

        ]);
    }
    public function onChangeSelectProduct()
    {
        $this->products = Product::all()->where('state', 'ACTIVE');
    }
}
