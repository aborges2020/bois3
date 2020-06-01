<?php

namespace App\Http\Controllers\Admin\PaymentMethods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use DataTables;
use Validator;

class PaymentMethodsController extends Controller
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
            $data = PaymentMethod::latest()->get();
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
        
        return view('admin.paymentMethods.payment_methods');
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
            'name'        => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:250'],
            'image'       => ['required', 'string', 'max:50'],
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
            'name'        => $request->name,
            'description' => $request->description,
            'active'      => $active,
            'image'       => $request->image,
        );

        PaymentMethod::create($form_data);

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
            $data = PaymentMethod::findOrFail($id);
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
    public function update(Request $request, PaymentMethod $id)
    {
        $rules = array(
            'name'        => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:150'],
            'image'       => ['required', 'string', 'max:50']
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
            'name'        => $request->name,
            'description' => $request->description,
            'active'      => $active,
            'image'       => $request->image,
            );

            PaymentMethod::whereId($request->hidden_id)->update($form_data);

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
        $data = PaymentMethod::findOrFail($id);
        $data->delete();
    }
}
