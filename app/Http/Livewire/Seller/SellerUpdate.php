<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;
use App\Models\Seller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class SellerUpdate extends Component
{
    use WithFileUploads;

    public $seller;
    public $name;
    public $slug;
    public $state;

    //Constructor
    public function mount($slug)
    {
        $this->seller = Seller::where('slug', $slug)->firstOrFail();
        if ($this->seller) {
            $this->name = $this->seller->name;
            $this->slug = $this->seller->slug;
            $this->state = $this->seller->state;
        }
    }
    public function render()
    {
        return view('livewire.seller.seller-update');
    }

    public function generateSlug()
    {
            $this->slug = Str::slug(bcrypt(time()));
    }
    protected $rules = [
        'name' => 'required|max:255|min:3',
        'state' => 'required',
    ];

    public function submit()
    {
        //Modificando regla para actualizar
        $this->rules['slug'] = 'required|unique:types,slug,' . $this->seller->id;
        $this->validate();
        $this->seller->update([
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
        return redirect()->route('seller.dashboard');
    }
}
