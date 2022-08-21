<?php

namespace App\Http\Livewire\Note;

use App\Models\Client;
use App\Models\Note;
use App\Models\Productnote;
use Livewire\Component;

class NoteInformation extends Component
{
    //Note
    public $note;
    public $total;
    //Person
    public $client;
    public $num_cell;
    public $name;
    //productnotes
    public $productnotes;
    public $slug;


    public function mount($slug)
    {
        $this->note = Note::where('slug', $slug)->firstOrFail();
        if ($this->note) {
            $this->client = Client::where('id', $this->note->client_id)->firstOrFail();
            $this->productnotes = Productnote::all()->where('note_id', $this->note->id);
            $this->name = $this->client->name;
            $this->num_cell = $this->client->num_cell;
            $this->total = $this->note->total;
        }
    }
    public function render()
    {
        return view('livewire.note.note-information');
    }
}
