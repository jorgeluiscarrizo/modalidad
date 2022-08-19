<?php

namespace App\Http\Livewire\Goal;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class GoalUpdate extends Component
{
    use WithFileUploads;

    public $goal;
    public $date_i;
    public $date_f;
    public $amount;
    public $bonus;
    public $slug;
    public $state;

    public $thumbnail_new;

    //Constructor
    public function mount($slug)
    {
        $this->goal = Goal::where('slug', $slug)->firstOrFail();
        if ($this->goal) {
            $this->date_i = $this->goal->date_i;
            $this->date_f = $this->goal->date_f;
            $this->amount = $this->goal->amount;
            $this->bonus = $this->goal->bonus;
            $this->slug = $this->goal->slug;
            $this->state = $this->goal->state;
        }
    }
    public function render()
    {
        return view('livewire.goal.goal-update');
    }

    public function generateSlug()
    {
            $this->slug = Str::slug(bcrypt(time()));
    }
    protected $rules = [
        'date_i' => 'required',
        'date_f' => 'required|after:date_i|after:date_i',
        'amount' => 'required',
        'bonus' => 'required',
        'state' => 'required',
    ];

    public function submit()
    {
        //Modificando regla para actualizar
        $this->rules['slug'] = 'required|unique:goals,slug,' . $this->goal->id;
        $this->validate();

        $this->goal->update([
            'date_i' => $this->date_i,
            'date_f' => $this->date_f,
            'amount' => $this->amount,
            'bonus' => $this->bonus,
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
        return redirect()->route('goal.dashboard');
    }
}
