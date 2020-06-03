<?php

namespace App\Http\Controllers\Admin\WishList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\WishList;
use DataTables;
use Validator;

class WishListController extends Controller
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
            $data = WishList::with('product:id,productName')->latest()->get();
            
            return DataTables::of($data)
                    ->addColumn('sending_status', function($data){
                        $checkBox = $data->sending_status == 1 ? '<i class="fas fa-check-square">': '</i><i class="far fa-square"></i>';
                        return $checkBox;
                    })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action', 'sending_status'])
                    ->make(true);
        }
        
        return view('admin.wishList.wish_list');
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
            'product_id'     => ['required', 'integer', 'max:11'],
            'name'           => ['required', 'string', 'max:50'],
            'email'          => ['required', 'string', 'max:50'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if(isset($request->sending_status)) {
            $sending_status = 1;
        }else{
            $sending_status = 0;
        }

        $form_data = array(
            'product_id'     => $request->product_id,
            'name'           => $request->name,
            'email'          => $request->email,
            'sending_status' => $sending_status,
        );

        WishList::create($form_data);

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
            $data = WishList::findOrFail($id);
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
    public function update(Request $request, WishList $id)
    {
        $rules = array(
            'product_id'     => ['required', 'integer', 'max:11'],
            'name'           => ['required', 'string', 'max:50'],
            'email'          => ['required', 'string', 'max:50'],
            // 'sending_status' => ['required', 'integer', 'max:11'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if(isset($request->sending_status)) {
            $sending_status = 1;
        }else{
            $sending_status = 0;
        }

        $form_data = array(
            'product_id'     => $request->product_id,
            'name'           => $request->name,
            'email'          => $request->email,
            'sending_status' => $sending_status,
            );

            WishList::whereId($request->hidden_id)->update($form_data);

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
        $data = WishList::findOrFail($id);
        $data->delete();
    }
}
