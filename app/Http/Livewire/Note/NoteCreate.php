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
    public $client_id;
    //Cliente seleccionado
    public $client;

    public $sellers;
    public $seller_id;
    public $seller;

    public $batchs;
    public $batch_id;
    public $batch;

    public $cart;

    public $cart_session_ = [];

    public function mount()
    {
        $this->clients = Client::all()->where('state', 'ACTIVE');
        $this->sellers = Seller::all()->where('state', 'ACTIVE');
        //$this->batchs = Batch::where('state', 'ACTIVE')->with('product')->get();
        $this->batchs = Batch::all()->where('state', 'ACTIVE');
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
        'client_id' => 'required',
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
                'client_id' => $this->client_id,
                'seller_id' => $this->seller_id,
                'state' => 'ACTIVE',
            ]);
            $cart_session_ = session()->get('cart');
            foreach ($cart_session_ as $id_ => $item) {
                //dd($item,'id ',$id_,'id nota',$note->id,);
                Productnote::create([
                    'amount' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                    'batch_id' => $id_,
                    'note_id' => $note->id,
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
            //dd($batch);
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
        $this->client = Client::find($this->client_id);
        //dd($this->client);
        //Limpiando carrito
        session()->forget('cart');
    }
    public function showInfoSeller()
    {
        $this->seller = Seller::find($this->seller_id);
        //Limpiando carrito
        session()->forget('cart');
    }
    public function showInfoBatch()
    {
        $this->batch = Batch::find($this->batch_id);
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

        $this->cart->addProductCart($this->batch_id, 1, $price);
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