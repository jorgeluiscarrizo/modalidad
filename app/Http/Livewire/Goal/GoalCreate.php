<?php

namespace App\Http\Livewire\Goal;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class GoalCreate extends Component
{
    use WithFileUploads;

    public $goal;
    public $date_i;
    public $date_f;
    public $amount;
    public $bonus;
    public $slug;
    public $state = 'ACTIVE';


    //Funcion para generar Slug para la URL
    public function generateSlug()
    {
        $this->slug = Str::slug(bcrypt(time()));
    }

    //Reglas para validar
    protected $rules = [
        'date_i' => 'required',
        'date_f' => 'required|after:date_i|after:date_i',
        'amount' => 'required',
        'bonus' => 'required',
        'state' => 'required',
    ];
    
    //Funcion para registrar el goal 
    public function submit()
    {
        $this->validate();
        $this->goal = Goal::create([
            'date_i' => $this->date_i,
            'date_f' => $this->date_f,
            'amount' => $this->amount,
            'bonus' => $this->bonus,
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
       
    }

    protected $listeners = [
        'confirmed',
    ];

    public function confirmed()
    {
        return redirect()->route('goal.dashboard');
    }
    //direccion
    public function render()
    {
        return view('livewire.goal.goal-create');
    }
}
