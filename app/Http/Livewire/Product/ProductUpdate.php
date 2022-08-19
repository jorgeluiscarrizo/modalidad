<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ProductUpdate extends Component
{
    use WithFileUploads;

    public $product;
    public $name;
    
    public $description;
    public $slug;
    public $state;

    //Constructor
    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        if ($this->product) {
            $this->name = $this->product->name;
            $this->description = $this->product->description;
            $this->slug = $this->product->slug;
            $this->state = $this->product->state;
        }
    }
    public function render()
    {
        return view('livewire.product.product-update');
    }

    public function generateSlug()
    {
            $this->slug = Str::slug(bcrypt(time()));
    }
    protected $rules = [
        'name' => 'required|unique:products,name',
        
        'state' => 'required',
    ];

    public function submit()
    {
        //Modificando regla para actualizar
        $this->rules['slug'] = 'required|unique:products,slug,' . $this->product->id;
        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'slug' => Str::slug(bcrypt(time())),
            'state' => $this->state,
        ]);
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
        return redirect()->route('product.dashboard');
    }
}
