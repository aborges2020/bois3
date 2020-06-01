<?php

namespace App\Http\Controllers\Site\MyAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Telephone;
use Redirect, Response;
use Validator;

class TelephoneController extends Controller
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
        $telephone = Telephone::where('client_id', $client->id)->get();
        //dd($telephone);
        //$telephone = [$telephone->id, $telephone->number, $telephone->primaryTelephone];
        return Response::json($telephone);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $telephone  = Telephone::where($where)->first();

        return Response::json($telephone);
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

        if(isset($request->primaryTelephone)) {
            $primaryTelephone = 1;
        }else{
            $primaryTelephone = 0;
        }

        $telephone = new Telephone;

        $telephone->number           = $request->telNumber;
        $telephone->primaryTelephone = $primaryTelephone;
        $telephone->client_id        = $client_id;

        $telephone->save();
        
        return Response::json($telephone);
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
        $telephone = Telephone::find($id);

        if(isset($request->primaryTelephone)) {
            $primaryTelephone = 1;
        }else{
            $primaryTelephone = 0;
        }

        $telephone->number           = $request->telNumber;
        $telephone->primaryTelephone = $primaryTelephone;

        $telephone->save();
        
        return Response::json($telephone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $telephone = Telephone::where('id', $id)->delete();
        
        return Response::json($telephone);
    }
}
