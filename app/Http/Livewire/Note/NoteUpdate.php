<?php

namespace App\Http\Livewire\Note;

use Livewire\Component;

class NoteUpdate extends Component
{
    //Note
    public $total;
    //productnotes
    public $productnotes;
    public $slug;
    public $note;


    public function mount($slug)
    {
        $this->note = Note::where('slug', $slug)->firstOrFail();
        if ($this->note) {
            $this->client = Client::where('id', $this->note->client_id)->firstOrFail();
            $this->productnotes = Productnote::all()->where('note_id', $this->note->id);

            $this->name = $this->person->name;
            $this->ci = $this->person->ci;
            $this->expedition_ci = $this->person->expedition_ci;
            $this->code_ci = $this->person->code_ci;
            $this->address = $this->person->address;
            $this->total = $this->note->total;
        }
    }
    public function render()
    {
        return view('livewire.note.note-update');
    }
    protected $rules = [
        'total' => 'required',
        'state' => 'required',
    ];
    public function submit()
    {
        //Funcion para validar mediante las reglas
        $this->rules['total'];
        $this->validate();

        //Creando registro
        $this->note->update([
            'total' => $this->total,
            'state' => $this->state,
        ]);
        //Llamando Alerta
        $this->alert('success', 'Registro actualizado correctamente', [
            'toast' => true,
            'position' => 'top-end',
        ]);
    }
}
