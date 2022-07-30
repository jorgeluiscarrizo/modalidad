<?php

namespace App\Http\Livewire\City;

use Livewire\Component;
use App\Models\City;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CityUpdate extends Component
{
    use WithFileUploads;

    public $city;
    public $name;
    public $slug;
    public $state;

    public $thumbnail_new;

    //Constructor
    public function mount($slug)
    {
        $this->city = City::where('slug', $slug)->firstOrFail();
        if ($this->city) {
            $this->name = $this->city->name;
            $this->slug = $this->city->slug;
            $this->state = $this->city->state;
        }
    }
    public function render()
    {
        return view('livewire.city.city-update');
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
        $this->rules['slug'] = 'required|unique:cities,slug,' . $this->city->id;
        $this->validate();

        $this->city->update([
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
        return redirect()->route('city.dashboard');
    }
}
