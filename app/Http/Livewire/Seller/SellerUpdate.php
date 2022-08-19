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
    public $ci;
    public $cell;
    public $slug;
    public $state = 'ACTIVE';

    //Constructor
    public function mount($slug)
    {
        $this->seller = Seller::where('slug', $slug)->firstOrFail();
        if ($this->seller) {
            $this->name = $this->seller->name;
            $this->ci = $this->seller->ci;
            $this->cell = $this->seller->cell;
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
        'ci' => 'numeric|required|unique:sellers,ci',
        'cell' => 'numeric|required',
        'state' => 'required',
    ];

    public function submit()
    {
        //Modificando regla para actualizar
        $this->rules['slug'] = 'required|unique:sellers,slug,' . $this->seller->id;
        $this->validate();
        $this->seller->update([
            'name' => $this->name,
            'ci' => $this->ci, 
            'cell' => $this->cell, 
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
