<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Products;
use App\Orders;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Products::all();
        return view('home')->with('products',$products);
    }

    public function cart()
    {
        return view('users.cart');
    }

    public function addToCart($id)
    {
 		$product = Products::find($id);
 
        if(!$product) {
            abort(404);
        }
 
        $cart = session()->get('cart');
 
        /*if cart is empty then this the first product*/
        if(!$cart) {
 
            $cart = [
                    $id => [
                        "title" => $product->title,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image" => $product->image
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        /*if cart not empty then check if this product exist then increment quantity*/
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
 
        /*if item not exist in cart then add to cart with quantity = 1*/
        $cart[$id] = [
            "title" => $product->title,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart');
    	if(isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
 
            $cart[$id]['quantity']--;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }
    	session()->forget('cart.'.$id);
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function checkout()
    {
        if(empty(session('cart'))) {
            redirect('cart');
        }
        $user = Auth::user();
        $products = session('cart');
        return view('users.checkout')->with(['products'=>$products,'user'=>$user]);
    }

    public function placeOrder()
    {
        if(empty(session('cart'))) {
            redirect('cart');
        }
        $user = Auth::user();
        $products = session('cart');
        foreach ($products as $id => $product) {
            $orders = array('user_id'=>$user->id,'product_id'=> $id,'quantity'=>$product['quantity'],'status'=>1);
            Orders::create($orders);
        }
        session()->forget('cart');
        return redirect('/home')->with('success', 'Your order placed successfully!');
    }
}
