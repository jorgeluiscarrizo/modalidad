<?php

namespace App\Http\Livewire\Note;

use Livewire\Component;
use App\Models\Note;
use App\Models\Client;
use App\Models\Batch;
use App\Models\Cart;
use App\Models\Seller;
use App\Models\Productnote;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class NoteCreate extends Component
{
    public $total;
    public $slug;


    public $clients;
    public $id_clients;
    public $client;

    public $sellers;
    public $id_sellers;
    public $seller;

    public $batchs;
    public $id_batches;
    public $batch;

    public $cart;

    public $cart_session_ = [];

    public function mount()
    {
        $this->clients = Client::all()->where('state', 'ACTIVE');
        $this->sellers = Seller::all()->where('state', 'ACTIVE');
        $this->batchs = Batch::where('state', 'ACTIVE')->with('product')->get();
        $this->cart = new Cart();
        //Limpiando carrito
        session()->forget('cart');
        //$this->cart_session_ = session()->get('cart');
    }

    public function render()
    {
        $this->cart_session_ = session()->get('cart');
        return view('livewire.note.note-create');
    }

    //reglas para validacion
    protected $rules = [
        'id_clients' => 'required',
    ];

    //Metodo que llama el formulario
    public function submit()
    {

        //Funcion para validar mediante las reglas
        $this->validate();
        if ($this->checkStock()) {
            
            $note = Note::create([
                'total' => $this->cart->total,
                //encriptando slug
                'slug' => Str::slug(bcrypt(time())),
                'id_clients' => $this->id_clients,
                'id_sellers' => $this->id_sellers,
                'state' => 'ACTIVE',
            ]);
            $cart_session_ = session()->get('cart');
            foreach ($cart_session_ as $id_ => $item) {

                SaleDetail::create([
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                    'id_batches' => $id_,
                    'id_notes' => $note->id,
                ]);
            }
            $this->cleanInputs();

            $this->confirm('Registro creado correctamente', [
                'icon' => 'success',
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'showCancelButton' => false,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Aceptar',
                'onConfirmed' => 'confirmed',
            ]);
            $this->updateStock();
        }
    }
    //Funcion comparar
    public function checkStock(){
        $cart_session_ = session()->get('cart');
        foreach ($cart_session_ as $id_ => $item) {

            $batch = Batch::find($id_);
            if ($item['quantity'] > $batch->stock) {
                /*Mostrando mensaje */
                $this->alert('error', 'La cantidad <span class=" text-red-500 font-bold text-xl">'.$item['quantity']. '</span> es superior al stok disponible.', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                ]);
                return false;
            }
        }
        return true;
    }
    public function updateStock(){
        $cart_session_ = session()->get('cart');
        foreach ($cart_session_ as $id_ => $item) {
            $batch = Batch::find($id_);
            $batch->stock =$batch->stock-$item['quantity'];
            $batch->update([
                'stock' => $batch->stock,           
            ]);
        }
    }
    //Funcion para limpiar imputs
    public function cleanInputs()
    {
        $this->total = "";
    }

    //Escuchadores para botones de alertas
    protected $listeners = [
        'confirmed',
    ];

    //Funcion que llama la alerta para redigir al dashboar
    public function confirmed()
    {
        return redirect()->route('note.dashboard');
    }

    public function showInfoClient()
    {
        $this->client = Client::find($this->id_clients);
        //Limpiando carrito
        session()->forget('cart');
    }
    public function showInfoSeller()
    {
        $this->seller = Seller::find($this->id_sellers);
        //Limpiando carrito
        session()->forget('cart');
    }
    public function showInfoBatch()
    {
        $this->batch = Batch::find($this->id_batches);
    }

    //Funciones para carrito de compras
    public function addItemCart()
    {
        //Validar antes de agregar
        if (!$this->client) {
            $this->alert('error', 'Seleccione un cliente.', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
            ]);
            return;
        }
        //$this->batch
        $price = 0;
        $price = $this->batch->price;

        $this->cart->addProductCart($this->id_batches, 1, $price);
        $this->toastAddProduct($this->batch->name);
    }
    public function updateQuantity($id)
    {
        foreach ($this->cart_session_ as $id_ => $item) {
            if ($id_ == $id) {
                $this->cart->updateProductCart($id, $item['quantity']);
            }
        }
    }
    public function deletProductCart($id)
    {
        $this->batch = Batch::find($id);
        $this->cart->deletProductCart($id);
        $this->alert('info', 'Producto:&nbsp;<span class="text-black font-black">' . $this->batch->name . '</span>, quitado correctamente.', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
        ]);
    }
    public function toastAddProduct($name)
    {

        $this->alert('success', 'Producto:&nbsp;<span class="text-black font-black">' . $name . '</span>, agregado correctamente.', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
        ]);
    }
    function viewCart()
    {
        dd(session()->all());
    }
}