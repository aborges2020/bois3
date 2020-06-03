<?php

namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Validator;

class ConfigController extends Controller
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
    public function index()
    {
        $data = Config::where('id', 1)->firstOrFail();

        return view('admin.config.config', ['config' => $data ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $config = Config::find(1);
        
        $rules = array(
            'name'      => ['required', 'string', 'max:50'],
            'email'     => ['required', 'string', 'email', 'max:255'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $config->name      = $request->name;
        $config->address   = $request->address;
        $config->data_bank = $request->data_bank;
        $config->email     = $request->email;
        $config->facebook  = $request->facebook;
        $config->instagram = $request->instagram;
        $config->telephone = $request->telephone;
        
        $config->save();

        return response()->json(['success' => 'Data is successfully updated', 'data' => $config]);
    }    
}
