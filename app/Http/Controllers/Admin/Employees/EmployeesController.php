<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use DataTables;
use Validator;

class EmployeesController extends Controller
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
            $data = Employee::latest()->get();
            return DataTables::of($data)
                    ->addColumn('position', function($data) {
                        $positionName = $data->position['name'];
                        return $positionName;
                    })
                    ->addColumn('role', function($data) {
                        $roleName = $data->role['name'];
                        return $roleName;
                    })
                    ->addColumn('active', function($data){
                        $checkBox = $data->active == 1 ? '<i class="fas fa-check-square">': '</i><i class="far fa-square"></i>';
                        return $checkBox;
                    })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action', 'active', 'position', 'role'])
                    ->make(true);
        }
        
        return view('admin.employees.employees');
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
            'firstName' => ['required', 'string', 'max:50'],
            'lastName'  => ['required', 'string', 'max:50'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'position'  => 'required',
            'role'      => 'required',
            'active'    => 'required',
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
            'firstName'   => $request->firstName,
            'lastName'    => $request->lastName,
            'email'       => $request->email,
            'password'    => Hash::make(1234),
            'position_id' => $request->position,
            'role_id'     => $request->role,
            'active'      => $active,
        );

        Employee::create($form_data);

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
            $data = Employee::findOrFail($id);
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
    public function update(Request $request, Employee $id)
    {
        $rules = array(
            'firstName' => ['required', 'string', 'max:50'],
            'lastName'  => ['required', 'string', 'max:50'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'role'      => 'required',
            'position'  => 'required',
            'active'    => 'required' 
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
            'firstName'   => $request->firstName,
            'lastName'    => $request->lastName,
            'email'       => $request->email,
            'role_id'     => $request->role,
            'position_id' => $request->position,
            'active'      => $active 
        );

        Employee::whereId($request->hidden_id)->update($form_data);

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
        $data = Employee::findOrFail($id);
        $data->delete();
    }
}
