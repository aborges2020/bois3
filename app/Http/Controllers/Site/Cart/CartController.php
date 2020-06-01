<?php

namespace App\Http\Controllers\Site\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Response;

class CartController extends Controller
{
    public function index()
    {
        $payments = PaymentMethod::where('active', 1)->get();
        $shippings = ShippingMethod::where('active', 1)->get();
        
        return view('site.cart.cart', ['payments'=> $payments, 'shippings' => $shippings]);
    }

    public function addProduct($id)
    {
        $product = Product::find($id);

        // $where = array('product_id' => $id, 'widget' => 1);
        // $productImage  = ProductImage::where($where)->first();

        if(!$product) {
            abort(404);
        }

        $cart = session()->get('cart');
        
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $id => [
                    "productName" => $product->productName,
                    "quantity"    => 1,
                    "price"       => $product->price,
                    "image"       => $product->image,
                ]
            ];

            session()->put('cart', $cart);
            $addedProduct = $cart[$id];
            return Response::json(['msg' => 'Product added to cart successfully!', 'addedProduct' => $addedProduct]);
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return Response::json(['msg' => 'Product added to cart successfully!']);
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "productName" => $product->productName,
            "quantity"    => 1,
            "price"       => $product->price,
            "image"       => $product->image,
        ];

        session()->put('cart', $cart);
        $addedProduct = $cart[$id];

        return Response::json(['msg' => 'Product added to cart successfully!', 'addedProduct' => $addedProduct]);
    }

    public function removeProduct(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            $total = $this->getCartTotal();

            return Response::json(['msg' => 'Product removed successfully', 'total' => $total]);
        }
    }

    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            $subTotal = $cart[$request->id]['quantity'] * $cart[$request->id]['price'];

            $total = $this->getCartTotal();

            return Response::json(['msg' => 'Cart updated successfully', 'total' => $total, 'subTotal' => $subTotal]);
        }
    }

    /**
     * getCartTotal
     * @return float|int
     */
    public function getCartTotal()
    {
        $total = 0;
        $qty = 0;

        $cart = session()->get('cart');
        
        if(isset($cart)){
            foreach($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
                $qty += $details['quantity'];
            }
        }

        return Response::json(['total' => number_format($total, 2), 'qty' => $qty]);
    }
    
    public function clearCart(Request $request) 
    {
        // Forget a single key...
        $request->session()->forget('cart');

        return Response::json(['msg' => 'The shopping cart is clean!']);
    }
}
