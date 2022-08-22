<?php

namespace App\Http\Livewire\Note;

use App\Models\Client;
use App\Models\Note;
use App\Models\Productnote;
use Livewire\Component;

class NotePrint extends Component
{
    public $note;
    public $productnotes;
    public $client;
    public $person;
    public function mount($slug)
    {
        $this->note = Note::where('slug', $slug)->firstOrFail();
        if ($this->note) {
            $this->productnotes = Productnote::all()->where('note_id', $this->note->id);
            $this->client = Client::where('id', $this->note->client_id)->firstOrFail();
        }
    }
    public function render()
    {
        return view('livewire.note.note-print')->layout('layouts.guest');
    }
}
