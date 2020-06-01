<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use DataTables;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Http\UploadedFile;

class CategoriesController extends Controller
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
            $data = Category::latest()->get();
            return DataTables::of($data)
                    ->addColumn('image', function($data) {
                        $image = '<img class="" src="/img/default/default-50x50.jpg' . '">';
                        if($data->image) {
                            $image = '<img class="" src="/img/categories/' . $data->image .'" style="width:50px; height:50px;">';
                        }
                        return $image;
                    })
                    ->addColumn('active', function($data){
                        $checkBox = $data->active == 1 ? '<i class="fas fa-check-square">': '</i><i class="far fa-square"></i>';
                        return $checkBox;
                    })
                    ->addColumn('action', function($data){
                        // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>';
                        $button = '<a href="/admin/categories/' . $data->id . '" class="btn btn-link btn-sm">Details</a>';
                        $button .= '&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['image', 'action', 'active'])
                    ->make(true);
        }
        
        return view('admin.categories.categories');
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
            'categoryName'   => ['required', 'string', 'max:50'],
            'description'    => ['required', 'string', 'max:255'],
            //'seoTitle'       => ['required', 'string', 'max:60'],
            //'seoDescription' => ['required', 'string', 'max:120'],
            //'image'          => ['required|image|mimes:jpeg,png,jpg,gif|max:2048'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        //dd($file_local);
        //dd($request->hasFile('image'));
        
        $form_data = array(
            'categoryName'   => Str::ucfirst($request->categoryName),
            'slug'           => Str::slug($request->categoryName, '-'),
            'description'    => $request->description,
            'subCategory'    => $request->subCategory,
            'seoTitle'       => Str::ucfirst($request->categoryName),
            'seoDescription' => $request->description
        );

        Category::create($form_data);

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
            $data = Category::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function show($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.categories.category_details', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSeo(Request $request, Category $id)
    {
        $rules = array(
            'categoryName'   => ['required', 'string', 'max:50'],
            'slug'           => ['required', 'string', 'max:50'],
            'seoDescription' => ['string', 'max:120'], 
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'categoryName'   => Str::ucfirst($request->categoryName),
            'slug'           => Str::slug($request->slug, '-'),
            'seoDescription' => $request->seoDescription
        );

        Category::whereId($request->hidden_id)->update($form_data);
        
        $categoryName   = $form_data['categoryName'];
        $slug           = $form_data['slug'];
        $seoTitle       = $form_data['categoryName'];
        $seoDescription = $form_data['seoDescription'];

        return response()->json(['success' => 'Data is successfully updated', 
                                 'seoTitle' => $seoTitle, 
                                 'seoDescription' => $seoDescription, 
                                 'categoryName' => $categoryName,
                                 'slug' => $slug,
                                ]);
    }

    /**
     * 
     */
    public function updateActive(Request $request, Category $id)
    {
        if(isset($request->active)) {
            $active = 1;
        }else{
            $active = 0;
        }
        
        $form_data = array(
            'active' => $active, 
        );

        Category::whereId($request->hidden_id)->update($form_data);
        
        return response()->json(['success' => 'Data is successfully updated', 'active' => $active]);
    }

    /**
     * 
     */
    public function updateDetails(Request $request, Category $id)
    {
        //dd(request()->route('id'));

        $rules = array(
            // 'slug'           => ['required', 'string', 'max:50'],
            'description'    => ['required', 'string', 'max:500'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            // 'categoryName'   => Str::ucfirst($request->categoryName),
            // 'slug'           => Str::slug($request->slug, '-'),
            'description'    => $request->description,
            'subCategory'    => $request->subCategory,
        );

        Category::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * 
     */
    public function uploadImage(Request $request, Category $id)
    {
        if($request->hasFile('image'))
        {
            $imgFile = $request->file('image');
            $imgExtension = $request->file('image')->getClientOriginalExtension();
            
            if($imgExtension == 'jpg' || $imgExtension == 'png' || $imgExtension == 'jpeg')
            {
                $imgName = $request->file('image')->getClientOriginalName();
                $imgFile->move(public_path('img/categories'), $imgName);
            }
        }

        $category = Category::findOrFail($request->hidden_id);
        $image_path = public_path('img/categories/') . $category->image;
        //dd($image_path);
        
        // Update
        $form_data = array(
            'image' => $imgName,
        );
        
        Category::whereId($category->id)->update($form_data);
        // Delete old image on path
        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        return response()->json(['success' => 'Image is successfully updated', 'uploaded_image' => '<img src="/img/categories/'. $imgName .'" class="img-fluid" />']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        
        $image_path = public_path('img/categories') . $data->image;
        
        if(file_exists($image_path))
        {
            unlink($image_path);
        }
        
        $data->delete();
    }
}
