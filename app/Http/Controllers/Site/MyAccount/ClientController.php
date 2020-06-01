<?php

namespace App\Http\Controllers\Site\MyAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Client;
use Redirect, Response;
use Validator;

class ClientController extends Controller
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

    public function index()
    {
        $client = Auth::user();       

        return Response::json([
                                'id'        => $client->id,
                                'firstName' => $client->firstName,
                                'lastName'  => $client->lastName,
                                'email'     => $client->email,
                                'image'     => $client->image,
                            ]);
    }

    public function show($id)
    {
        $where  = array('id' => $id);
        $client = Client::where($where)->first();

        return Response::json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $client = Auth::user();

        $client->id        = $client->id;
        $client->firstName = $request->firstName;
        $client->lastName  = $request->lastName;
        $client->email     = $request->email;
        $client->save();       
        
        //return Response::json($client);
        return Response::json(['client' => $client, 'msg' => '<span class="text-success"><p>Profile updated successfully.</p></span>']);
    }
    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request)
    {
        $client = Auth::user();

        // $validatedData = $request->validate([
        //     'password' => 'required|confirmed|min:4',
        // ]);
                
        // if($validatedData){
        //     $client->id       = $client->id;
        //     $client->password = Hash::make($request->password);
        //     $client->save();
        // }else{
        //     return Response::json(['msg' => '<span class="text-danger"><p>The password is different in fields!!!</p></span>']);
        // }

        if ($request->password == $request->password2)
        {   
            $client->id       = $client->id;
            $client->password = Hash::make($request->password);
            $client->save();
        }else{
            return Response::json(['msg' => '<span class="text-danger"><p>The password is different in fields!!!</p></span>']);
        }

        return Response::json(['msg' => '<span class="text-success"><p>Password updated successfully.</p></span>']);
    }
    
    
}
