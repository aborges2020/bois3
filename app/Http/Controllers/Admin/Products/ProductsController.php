<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\StockItem;
use App\Models\OrderItem;
use DataTables;
use Validator;
use Illuminate\Support\Str;

class ProductsController extends Controller
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
            $data = Product::latest()->get();
            
            return DataTables::of($data)
                ->addColumn('category_id', function($data){
                    $category = $data->category->categoryName;
                    return $category;
                })
                ->addColumn('sold', function($data){
                    $sold = OrderItem::where('product_id', $data->id)->count();;
                    return $sold;
                })
                ->addColumn('quantity', function($data){
                    $quantity = $data->quantity;
                    if($quantity < 0){
                        return '<span class="badge badge-danger">'. $quantity . '</span>';
                    }else if($quantity > 0){
                        return '<span class="badge badge-success">'. $quantity . '</span>';
                    }
                    return $quantity;
                })
                ->addColumn('image', function($data) {
                    $image = '<img class="" src="/img/default/default-50x50.jpg' . '">';
                    if($data->image) {
                        $image = '<img class="" src="/img/products/' . $data->image .'" style="width:50px; height:50px;">';
                    }
                    return $image;
                })
                ->addColumn('active', function($data){
                    $checkBox = $data->active == 1 ? '<i class="fas fa-check-square">': '</i><i class="far fa-square"></i>';
                    return $checkBox;
                })
                ->addColumn('action', function($data){
                    // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>';
                    $button = '<a href="/admin/products/' . $data->id . '" class="btn btn-link btn-sm">Details</a>';
                    $button .= '&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                    return $button;
                })
                ->rawColumns(['action', 'active', 'image', 'stock', 'sold', 'balance', 'quantity'])
                ->make(true);
        }

        $categories = Category::where('active', 1)->get();
        
        return view('admin.products.products', ['categories' => $categories]);
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
            'category_id'  => ['required'],
            'productName'  => ['required', 'string', 'max:50'],
            'quantity'     => ['required', 'max:10'],
            'price'        => ['required', 'max:11'],
            'description'  => ['required', 'string', 'max:500'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'category_id'  => $request->category_id,
            'productName'  => $request->productName,
            'quantity'     => $request->quantity,
            'price'        => $request->price,
            'description'  => $request->description,
            'slug'         => Str::slug($request->productName, '-'),
        );

        Product::create($form_data);

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
            $data = Product::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        return view('admin.products.product_details', ['data' => $data]);
    }

    /**
     * Update active attribut.
     */
    public function updateActive(Request $request, Product $id)
    {
        if(isset($request->active)) {
            $active = 1;
        }else{
            $active = 0;
        }
        
        $form_data = array(
            'active' => $active, 
        );

        Product::whereId($request->hidden_id)->update($form_data);
        
        return response()->json(['success' => 'Data is successfully updated', 'active' => $active]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSeo(Request $request, Product $id)
    {
        $rules = array(
            'productName'    => ['required', 'string', 'max:50'],
            'slug'           => ['required', 'string', 'max:50'],
            'seoDescription' => ['string', 'max:120'], 
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'productName'   => Str::ucfirst($request->productName),
            'slug'           => Str::slug($request->slug, '-'),
            'seoDescription' => $request->seoDescription
        );

        Product::whereId($request->hidden_id)->update($form_data);
        
        $productName   = $form_data['productName'];
        $slug           = $form_data['slug'];
        $seoTitle       = $form_data['productName'];
        $seoDescription = $form_data['seoDescription'];

        return response()->json(['success' => 'Data is successfully updated', 
                                 'seoTitle' => $seoTitle, 
                                 'seoDescription' => $seoDescription, 
                                 'productName' => $productName,
                                 'slug' => $slug,
                                ]);
    }

    /**
     * 
     */
    public function updateDetails(Request $request, Product $id)
    {
        $rules = array(
            'category_id'  => ['required'],
            'quantity'     => ['required', 'max:11'],
            'price'        => ['required', 'max:11'],
            'description'  => ['required', 'string', 'max:500'],
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'quantity'     => $request->quantity,
            'price'        => $request->price,
            'category_id'  => $request->category_id,
            'supplier_id'  => $request->supplier_id,
            'description'  => $request->description,
        );

        Product::whereId($request->hidden_id)->update($form_data);

        $quantity    = $form_data['quantity'];
        $price       = $form_data['price'];
        $category_id = $form_data['category_id'];
        $supplier_id = $form_data['supplier_id'];
        $description = $form_data['description'];
        
        return response()->json(['success'     => 'Data is successfully updated',
                                 'quantity'    => $quantity,
                                 'price'       => $price,
                                 'category_id' => $category_id,
                                 'supplier_id' => $supplier_id,
                                 'description' => $description,
                                ]);
    }

    /**
     * 
     */
    public function uploadImage(Request $request, Product $id)
    {
        if($request->hasFile('image'))
        {
            $imgFile = $request->file('image');
            $imgExtension = $request->file('image')->getClientOriginalExtension();
            
            if($imgExtension == 'jpg' || $imgExtension == 'png' || $imgExtension == 'jpeg')
            {
                $imgName = $request->file('image')->getClientOriginalName();
                $imgFile->move(public_path('img/products'), $imgName);
            }
        }

        $product = Product::findOrFail($request->hidden_id);
        $image_path = public_path('img/products/') . $product->image;
        
        // Update
        $form_data = array(
            'image' => $imgName,
        );
        
        Product::whereId($product->id)->update($form_data);

        // Delete old image on path
        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        return response()->json(['success' => 'Image is successfully updated', 'uploaded_image' => '<img class="img-fluid" src="/img/products/'. $imgName .'" class="img-fluid" />']);
    }

    /**
     * 
     */
    public function uploadProductImage(Request $request)
    {
        if($request->hasFile('image_pi'))
        {
            $imgFile = $request->file('image_pi');
            $imgExtension = $request->file('image_pi')->getClientOriginalExtension();
            
            if($imgExtension == 'jpg' || $imgExtension == 'png' || $imgExtension == 'jpeg')
            {
                $imageName = $request->file('image_pi')->getClientOriginalName();
                $imgFile->move(public_path('img/products'), $imageName);
            }
        }

        $product = Product::findOrFail($request->hidden_id);
        $image_path = public_path('img/products/') . $product->image;
        
        $product_id = $product->id;
        $imageName = $imageName;

        // $productImage = array(
        //     'product_id'   => $product->id,
        //     'imageName'    => $imageName,
        // );
        $productImage = new ProductImage;
        $productImage->product_id = $product->id;
        $productImage->imageName = $imageName;
        $productImage->save();
        
        return response()->json(['success' => 'Image is successfully added', 'productImage' => $productImage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Product $id)
    // {
    //     $rules = array(
    //         'category_id'  => ['required'],
    //         'productName'  => ['required', 'string', 'max:50'],
    //         'quantity'     => ['required', 'max:11'],
    //         'price'        => ['required', 'max:11'],
    //         'description'  => ['required', 'string', 'max:500'],
    //         'image'        => ['string', 'max:50'],
    //         'slug'         => ['string', 'max:50'],
    //     );
        
    //     $error = Validator::make($request->all(), $rules);

    //     if($error->fails())
    //     {
    //         return response()->json(['errors' => $error->errors()->all()]);
    //     }
        
    //     if(isset($request->active)) {
    //         $active = 1;
    //     }else{
    //         $active = 0;
    //     }
        
    //     $form_data = array(
    //         'category_id'  => $request->category_id,
    //         'productName'  => $request->productName,
    //         'quantity'     => $request->quantity,
    //         'price'        => $request->price,
    //         'description'  => $request->description,
    //         'slug'         => Str::slug($request->slug, '-'),
    //         'image'        => $request->image,
    //         'active'       => $active, 
    //     );

    //     Product::whereId($request->hidden_id)->update($form_data);

    //     return response()->json(['success' => 'Data is successfully updated']);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);

        $image_path = public_path('img/products') . $data->image;
        
        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        $data->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImg($id)
    {
        $productImage = ProductImage::where('id', $id)->findOrFail($id);
        
        $image_path = public_path('img/products') . $productImage->imageName;
        
        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        $productImage->delete();

        return response()->json(['success' => 'Image is deleted']);
    }
}
