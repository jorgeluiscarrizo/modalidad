<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


    protected $fillable = [
        'total',
        'count_items',
        'quantity_items',
    ];

    public function __construct()
    {
        $this->caculateCart();
    }

    public function addProductCart($id, $quantity, $price)
    {
     
        $product = Batch::find($id);
        $cart = session()->get('cart');

        //if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $price,
                    "subtotal" => $price * $quantity,
                ]
            ];
            session()->put('cart', $cart);
            $this->caculateCart();

        
            return;
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            //dd('arrived');
            $cart[$id]['quantity'] = $quantity + $cart[$id]['quantity'];
            $cart[$id]['subtotal'] = $cart[$id]['price'] * $cart[$id]['quantity'];

            session()->put('cart', $cart);
            $this->caculateCart();
            return;
        }

        //if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $price,
            "subtotal" => $price * $quantity,
        ];
        session()->put('cart', $cart);
        $this->caculateCart();
    }

    public function caculateCart()
    {
        $cart = session()->get('cart');
        $totalProductsInCart = 0;
        $quantityItems = 0;
        if ($cart) {
            foreach ($cart as $id => $item) {
                $totalProductsInCart += $item['subtotal'];
                $quantityItems += $item['quantity'];
            }
            $this->total = $totalProductsInCart;
            $this->count_items = count($cart);
            $this->quantity_items = $quantityItems;
        }
    }
    public function updateProductCart($id, $quantity)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {

            //dd('arrived');
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['subtotal'] = $cart[$id]['price'] * $cart[$id]['quantity'];

            session()->put('cart', $cart);
            $this->caculateCart();
            return;
        }
    }
    public function deletProductCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);
            $this->caculateCart();
            return;
        }
    }
}
