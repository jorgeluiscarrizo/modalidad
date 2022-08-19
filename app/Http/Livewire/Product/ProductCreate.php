<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $product;
    public $name;
    public $price;
    public $description;
    public $slug;
    public $state = 'ACTIVE';


    //Funcion para generar Slug para la URL
    public function generateSlug()
    {
        $this->slug = Str::slug(bcrypt(time()));
    }

    //Reglas para validar
    protected $rules = [
        'name' => 'required|unique:products,name',
        'state' => 'required',
    ];
    
    //Funcion para registrar el product 
    public function submit()
    {
        $this->validate();
        $this->product = Product::create([
            'name' => $this->name,
            'description'=>$this->description,
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
        return redirect()->route('product.dashboard');
    }
    //funcion para devolver la vista
    public function render()
    {
        return view('livewire.product.product-create');
    }
}
