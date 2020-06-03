<?php

namespace App\Http\Controllers\Site\MyOrders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class MyOrdersController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = Auth::user();
        $orders = Order::where([['client_id', $client->id], ['status_id', '<', 5]])->get();
        $ordersHistory = Order::where([['client_id', $client->id], ['status_id', '>=', 5]])->get();
        
        return view('site.myOrders.my_orders', ['orders' => $orders, 'ordersHistory'=> $ordersHistory]);
    }

    public function details($id)
    {
        $order = Order::where('id', $id)->firstOrFail();

        if($order->client_id == Auth::id())
        {
            $message = session()->get('message');
            
            return view('site.myOrders.order', ['message' => $message, 'order' => $order]);
        }

        $message = 'You were not allowed to access the requested url!';
        return back()->with(['error' => $message]);        
    }
}
