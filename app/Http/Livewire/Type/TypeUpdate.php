<?php

namespace App\Http\Livewire\Type;

use Livewire\Component;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class TypeUpdate extends Component
{
    use WithFileUploads;

    public $type;
    public $name;
    public $slug;
    public $state;

    public $thumbnail_new;

    //Constructor
    public function mount($slug)
    {
        $this->type = Type::where('slug', $slug)->firstOrFail();
        if ($this->type) {
            $this->name = $this->type->name;
            $this->slug = $this->type->slug;
            $this->state = $this->type->state;
        }
    }
    public function render()
    {
        return view('livewire.type.type-update');
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
        $this->rules['slug'] = 'required|unique:types,slug,' . $this->type->id;
        $this->validate();

        $this->type->update([
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
        return redirect()->route('type.dashboard');
    }
}
