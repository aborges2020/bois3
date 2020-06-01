<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupom;
use DataTables;
use Validator;

class CouponsController extends Controller
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
            $data = Coupom::latest()->get();
            return DataTables::of($data)
                    ->addColumn('active', function($data){
                        $checkBox = $data->active == 1 ? '<i class="fas fa-check-square">': '</i><i class="far fa-square"></i>';
                        return $checkBox;
                    })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action', 'active'])
                    ->make(true);
        }
        
        return view('admin.coupons.coupons');
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
            'code'       => ['required', 'alpha_num', 'max:10'],
            'start_date' => ['required'],
            'end_date'   => ['required'],
            'type'       => ['required'],
            'value'      => ['required', 'decimal', 'max:11'],
            'quantity'   => ['required', 'integer', 'max:11'],
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
            'code'       => $request->code,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'type'       => $request->type,
            'value'      => $request->value,
            'quantity'   => $request->quantity,
            'active'     => $active,
            
        );

        Coupom::create($form_data);

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
            $data = Coupom::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupom $id)
    {
        $rules = array(
            'code'       => ['required', 'alpha_num', 'max:10'],
            'start_date' => ['required'],
            'end_date'   => ['required'],
            'type'       => ['required'],
            'value'      => ['required', 'max:11'],
            'quantity'   => ['required', 'integer', 'max:11'],
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
            'code'       => $request->code,
            'start_date' => date($request->start_date  . ' ' . $request->start_hours . ':' . $request->start_minutes . ':00'),
            'end_date'   => date($request->end_date . ' ' . $request->end_hours . ':' . $request->end_minutes . ':00'),
            'type'       => $request->type,
            'value'      => $request->value,
            'quantity'   => $request->quantity,
            'active'     => $active,
            );

            Coupom::whereId($request->hidden_id)->update($form_data);

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
        $data = Coupom::findOrFail($id);
        $data->delete();
    }
}
