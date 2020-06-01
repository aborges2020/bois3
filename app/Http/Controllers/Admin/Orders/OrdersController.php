<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use Validator;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Order::latest()->get();
            
            return DataTables::of($data)
                    ->addColumn('id', function($data) {
                        $id = 'OR'.$data->id;
                        return $id;
                    })
                    ->addColumn('client_id', function($data) {
                        $client = $data->client->firstName . ' ' . $data->client->lastName;
                        return $client;
                    })
                    ->addColumn('status_id', function($data) {
                        if($data->status_id = 1) {
                            $status = '<span class="badge badge-warning">'. $data->status->name .'</span>';
                        }elseif($data->status_id = 2) {
                            $status = '<span class="badge badge-info">'. $data->status->name .'</span>';
                        }elseif($data->status_id = 3) {
                            $status = '<span class="badge badge-danger">'. $data->status->name .'</span>';
                        }elseif($data->status_id = 4){
                            $status = '<span class="badge badge-success">'. $data->status->name .'</span>';    
                        }
                        return $status;
                    })
                    ->addColumn('payment_id', function($data) {
                        $payment = $data->payment->name;
                        return $payment;
                    })
                    ->addColumn('shipping_id', function($data) {
                        $shipping = $data->shipping->name;
                        return $shipping;
                    })
                    ->addColumn('created_at', function($data) {
                        $date = date_format($data->created_at, 'Y-m-d H:i'); 
                        return $date;
                    })
                    ->addColumn('point_of_sale_id', function($data) {
                        if($data->point_of_sale == 0){
                            $pos = 'Site Web';
                        }else{
                            $pos = $data->pos->name;
                        }
                        return $pos;
                    })
                    ->addColumn('employee_id', function($data) {
                        if($data->employee == 0){
                            $employee = '-';
                        }else{
                            $pos = $data->employee->firstName . ' ' . $data->employee->lastName;
                        }
                        return $employee;
                    })
                    ->addColumn('action', function($data){
                        //$button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button = '<a href="/admin/orders/' . $data->id . '" class="btn btn-link btn-sm">Details</a>';
                        $button .= '&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action', 'client_id', 'status_id', 'shipping_id', 'payment_id', 'created_at'])
                    ->make(true);
        }
        
        return view('admin.orders.orders');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'client_id'        => ['required'],
            'order_status_id'  => ['required'],
            'payment_id'       => ['required'],
            'shipping_id'      => ['required'],
            'point_of_sale_id' => ['required'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if(isset($request->active)) {
            $active = 1;
        }else{
            $active = 0;
        }

        $form_data = array(
            'client_id'        => $request->client_id,
            'status_id'        => $request->status_id,
            'payment_id'       => $request->payment_id,
            'shipping_id'      => $request->shipping_id,
            'point_of_sale_id' => $request->point_of_sale_id,
            'employee'         => Auth::user()->id,
            'ip'               => Request::ip(),
        );

        Order::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Order::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function show($id)
    {
        $data = Order::findOrFail($id);
        return view('admin.orders.order_details', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $id)
    {
        $rules = array(
            'name'           => ['required', 'string', 'max:50'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if(isset($request->active)) {
            $active = 1;
        }else{
            $active = 0;
        }

        $form_data = array(
            'client_id'        => $request->client_id,
            'status_id'  => $request->status_id,
            'payment_id'       => $request->payment_id,
            'shipping_id'      => $request->shipping_id,
            'point_of_sale_id' => $request->point_of_sale_id,
            'employee'         => Auth::user()->id,
            );

            Order::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Order::findOrFail($id);
        $data->delete();
    }
}
