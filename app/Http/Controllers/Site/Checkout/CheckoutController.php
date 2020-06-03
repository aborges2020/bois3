<?php

namespace App\Http\Controllers\Site\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\ShippingMethod;
use App\Models\Coupom;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }   

    protected function checkout(Request $request) 
    {
        $cart_total = 0;
        $discount_value = 0;
        $shipping_cost = 0;

        // Check for cart items in stock 
        $cart = session()->get('cart');
        // Cart items
        $cartItems = array();
        // Cart items out of stock
        $items_out_of_stock = array();

        if(isset($cart)){
            foreach($cart as $id => $row) {
                $cartItems[] = [
                    'product_id' => $id,
                    'quantity'   => $row['quantity'],
                    'price'      => $row['price'],
                ];
                $cart_total += $row['price'] * $row['quantity'];        
            }
        }       

        foreach($cartItems as $item)
        {
            $product = Product::where([['id', $item['product_id']], ['active', 1]])->get();

            if($product[0]['quantity'] < $item['quantity']){
                
                // Delete items from the cart
                unset($cart[$item['product_id']]);
                // Add new cart to session
                session()->put('cart', $cart);
                
                // And add to array items_out_of_stock 
                $items_out_of_stock[] = [
                    'product_id'   => $product[0]['id'],
                    'product_name' => $product[0]['productName'],
                ];

                $cart_total -= $item['price'] * $item['quantity'];        
            }
        }

        if(count($items_out_of_stock) > 0)
        {
            return back()->with(['warning' => 'Excuse me! The products below were removed from the shopping cart because they were out of stock.', 
                                 'items_out_of_stock' => $items_out_of_stock,
                                 ]);
        }

        // Check if the shipping cost is valid 
        $shipping_method = ShippingMethod::where('id', $request->form_shipping_method)->get();
        
        if($shipping_method && $shipping_method[0]['cost'] == $request->form_shipping_cost)
        {
            $shipping_cost = $shipping_method[0]['cost'];
        }
        
        // Check if the coupon is valid.
        if($request->form_coupom_value != '')
        {
            $coupom = Coupom::where([['code', $request->form_coupom_code], ['active', 1], ['quantity', '>', 0]])->get();
            
            if($coupom)
            {
                // If type = 1 (money)
                $discount_value = $coupom[0]['value'];
                
                // If type = 2 (percentage)
                if($coupom[0]['type'] == 2)
                {
                    $discount_value = $cart_total * ($discount_value/100);
                }
                
                $coupom_id = $coupom[0]['id'];
            }
        }

        // Calculation of the total order after discount and shipping cost
        $total_order = ($cart_total - $discount_value) + $shipping_cost;

        // Order 
        $order = new Order;
        $order->client_id = Auth::id(); 
        $order->payment_id = $request->form_payment_method;
        $order->shipping_id = $request->form_shipping_method;
        $order->shipping_value = $shipping_cost;
        
        if(isset($coupom))
        {
            $order->coupom_id = $coupom_id;
            $order->discount_value = $discount_value;
        }

        $order->total = $total_order;
        //Insert Order =========================================
        $order->save();

        // Installments 
        $installments = $request->form_installment;
        $installment_value = $total_order / $installments;
        
        $orderInstallments = array();

        for ($i = 1; $i <= $installments; $i++)
        {
            $orderInstallments[] = [ 
                'order_id' => $order->id,
                'number'   => $i,
                'value'    => $installment_value,
                'due_date' => '2020-06-13' // today + $i month carbon
            ];
        };

        //Insert Installments ==================================
        foreach ($orderInstallments as $row) {
            $order->installments()->create([
                'order_id' => $row['order_id'],
                'number'   => $row['number'],
                'value'    => $row['value'],
                'due_date' => $row['due_date'], 
            ]);
        }

        // Insert Items ========================================
        foreach ($cartItems as $row) {
            $order->items()->create([
                'order_id'   => $order->id,
                'product_id' => $row['product_id'],
                'quantity'   => $row['quantity'],
                'price'      => $row['price'],
            ]);
        }      
        
        // Decrease quantity of products
        foreach($cartItems as $item)
        {
            $product = Product::where('id', $item['product_id'])->decrement('quantity', $item['quantity']);
        }
        
        // Decrease quantity of discount coupom if exists
        if(isset($coupom))
        {
            $coupom = Coupom::where('code', $coupom[0]['code'])->decrement('quantity', 1);
        }
        
        // Clear cart in session
        $request->session()->forget('cart'); // uncomment after finish
        
        // Redirect according to payment method
        // Cash = 1, Transfer = 2, Credit card = 3, add others...
        if ($order->payment_id == 1) {
            // Get bank details from the database
            $message = 'Thank you for your preference! To finalize your order, please make the payment now following the instructions according to the option chosen. Payment by cash!';
        }
        elseif($order->payment_id == 2 ) {
            // Get bank details from the database
            $message = 'Thank you for your preference! To finalize your order, please make the payment now following the instructions according to the option chosen. Payment by transfer!';
        }
        elseif($order->payment_id == 3 ) {
            $message = 'Thank you for your preference! To finalize your order, please make the payment now following the instructions according to the option chosen. Payment by credit card!';
        }
        
        return redirect()->route('my.orders.details', ['id' => $order->id])->with(['success' => $message]);
    
    }
}
