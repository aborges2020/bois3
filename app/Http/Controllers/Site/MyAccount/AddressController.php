<?php

namespace App\Http\Controllers\Site\MyAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Address;
use Redirect, Response;
use Validator;

class AddressController extends Controller
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

    public function index ()
    {
        $client = Auth::user();
        $address = Address::where('client_id', $client->id)->get();
        
        return Response::json($address);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $address  = Address::where($where)->first();

        return Response::json($address);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client_id = Auth::id();

        if(isset($request->primaryAddress)) {
            $primaryAddress = 1;
        }else{
            $primaryAddress = 0;
        }

        $address = new Address;

        $address->client_id        = $client_id;
        $address->address          = $request->address;
        $address->number           = $request->number;
        $address->city             = $request->city;
        $address->state            = $request->state;
        $address->country          = $request->country;
        $address->primaryAddress   = $primaryAddress;
        
        $address->save();
        
        return Response::json($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if(isset($request->primaryAddress)) {
            $primaryAddress = 1;
        }else{
            $primaryAddress = 0;
        }

        $address->address          = $request->address;
        $address->number           = $request->number;
        $address->city             = $request->city;
        $address->state            = $request->state;
        $address->country          = $request->country;
        $address->primaryAddress   = $primaryAddress;

        $address->save();
        
        return Response::json($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::where('id', $id)->delete();
        
        return Response::json($address);
    }
}
