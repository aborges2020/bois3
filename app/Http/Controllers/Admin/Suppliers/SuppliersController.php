<?php

namespace App\Http\Controllers\Admin\Suppliers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use DataTables;
use Validator;

class SuppliersController extends Controller
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
            $data = Supplier::latest()->get();
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
        
        return view('admin.suppliers.suppliers');
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
            'name'         => ['required', 'string', 'max:50'],
            'contact_name' => ['required', 'string', 'max:50'],
            'email'        => ['required', 'string', 'max:50'],
            'tel_number'   => ['required', 'string', 'max:15'],
            'cel_number'   => ['required', 'string', 'max:15'],
            'description'  => ['required', 'string', 'max:150'],
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
            'name'         => $request->name,
            'contact_name' => $request->contact_name,
            'email'        => $request->email,
            'tel_number'   => $request->tel_number,
            'cel_number'   => $request->cel_number,
            'description'  => $request->description,
            'active'       => $active,
        );

        Supplier::create($form_data);

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
            $data = Supplier::findOrFail($id);
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
    public function update(Request $request, Supplier $id)
    {
        $rules = array(
            'name'         => ['required', 'string', 'max:50'],
            'contact_name' => ['required', 'string', 'max:50'],
            'email'        => ['required', 'string', 'max:50'],
            'tel_number'   => ['required', 'string', 'max:15'],
            'cel_number'   => ['required', 'string', 'max:15'],
            'description'  => ['required', 'string', 'max:150'],
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
            'name'         => $request->name,
            'contact_name' => $request->contact_name,
            'email'        => $request->email,
            'tel_number'   => $request->tel_number,
            'cel_number'   => $request->cel_number,
            'description'  => $request->description,
            'active'       => $active,
            );

            Supplier::whereId($request->hidden_id)->update($form_data);

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
        $data = Supplier::findOrFail($id);
        $data->delete();
    }
}
