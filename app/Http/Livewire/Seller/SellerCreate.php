<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;
use App\Models\Seller;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class SellerCreate extends Component
{
    use WithFileUploads;

    public $seller;
    public $name;
    public $slug;
    public $state = 'ACTIVE';


    ///Funcion para generar Slug para la URL
    public function generateSlug()
    {
        $this->slug = Str::slug(bcrypt(time()));
    }

    //Reglas para validar
    protected $rules = [
        'name' => 'required|max:255|min:3',
        'state' => 'required',
    ];
    
    //Funcion para registrar el seller 
    public function submit()
    {
        $this->validate();
        $this->seller = Seller::create([
            'name' => $this->name, 
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
        return redirect()->route('seller.dashboard');
    }
    public function render()
    {
        return view('livewire.seller.seller-create');
    }
}
