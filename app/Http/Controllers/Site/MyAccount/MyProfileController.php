<?php

namespace App\Http\Controllers\Site\MyAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Redirect, Response;
use App\Models\Client;
use App\Models\Address;
use App\Models\Telephone;

class MyProfileController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //var_dump(Auth::user());die;
        // Get the currently authenticated user...
        //$client = Auth::user();
        //return view('myAccount.myProfile', compact('client'));
        return view('site.myAccount.myProfile');
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  * @param  [type] $id [description]
    //  * @return [type]     [description]
    //  */
    // public function profileEdit($id)
    // {
    //     $where = array('id' => $id);
    //     $client  = Client::where($where)->first();

    //     return Response::json($client);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function profileUpdate(Request $request)
    // {
    //     $client = Client::updateOrCreate(
    //         ['id' => $request->client_id],
    //         ['firstName' => $request->firstName, 
    //          'lastName'  => $request->lastName, 
    //          'email'     => $request->email]
    //     );

    //     return Response::json($client);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  * @param  [type] $id [description]
    //  * @return [type]     [description]
    //  */
    // public function addressEdit($id)
    // {
    //     $where = array('id' => $id);
    //     $address  = Address::where($where)->first();

    //     return Response::json($address);
    // }

    // /**
    //  * Store or update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function addressStore(Request $request)
    // {
    //     //$client_id = Auth::id();

    //     if(isset($request->primaryAddress)) {
    //         $primaryAddress = 1;
    //     }else{
    //         $primaryAddress = 0;
    //     }

    //     $address = Address::updateOrCreate(
    //         ['id' => $request->address_id],
    //             [//'client_id'      => $client_id,
    //              'address'        => $request->address, 
    //              'number'         => $request->number, 
    //              'city'           => $request->city,
    //              'state'          => $request->state,
    //              'country'        => $request->country,
    //              'primaryAddress' => $primaryAddress,
    //             ]);

    //     return Response::json($address);
    // }

    // /**
    //  * Destroy the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function addressDestroy($id)
    // {
    //     $address = Address::where('id', $id)->delete();
        
    //     return Response::json($address);
    // }
    
    // /**
    //  * Show the form for editing the specified resource.
    //  * @param  [type] $id [description]
    //  * @return [type]     [description]
    //  */
    // public function telephoneEdit($id)
    // {
    //     $where = array('id' => $id);
    //     $telephone  = Telephone::where($where)->first();

    //     return Response::json($telephone);
    // }

    // /**
    //  * Store or update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function telephoneStore(Request $request)
    // {
    //     //$client_id = Auth::id();

    //     //var_dump($client_id);die;

    //     if(isset($request->primaryTelephone)) {
    //         $primaryTelephone = 1;
    //     }else{
    //         $primaryTelephone = 0;
    //     }

    //     $telephone = Telephone::updateOrCreate(
    //         ['id' => $request->telephone_id],
    //             [//'client_id'        => $client_id,
    //              'number'           => $request->telNumber, 
    //              'primaryTelephone' => $primaryTelephone,
    //              ]);

    //     return Response::json($telephone);
    // }

    // /**
    //  * Destroy the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function telephoneDestroy($id)
    // {
    //     $telephone = Telephone::where('id', $id)->delete();
        
    //     return Response::json($telephone);
    // }
}
