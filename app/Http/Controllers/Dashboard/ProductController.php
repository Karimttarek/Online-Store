<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProductDataTable;
use App\Enums\ProductType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crud;
use App\Http\Traits\UploadImageTrait;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Throwable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductController extends Controller
{

    use UploadImageTrait;
    protected $table = 'products';
    protected $model = 'App\Models\product';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('dashboard.product.product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->select('id' , 'name', 'name_ar')->get();
        $subcategories = DB::table('subcategories')->select('id' , 'name', 'name_ar')->get();
        $brands = DB::table('brands')->select('id' , 'name', 'name_ar')->get();
        return view('dashboard.product.create' ,compact('categories' ,'subcategories' ,'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){

        $request->validate([
//            'product_id'=>['required'],
//            'image' => ['required'],
//            'path' => ['required']
        ]);
            $imageName = rand() . time() . '.' . $request->file->getClientOriginalExtension();
            $path = 'image/products';

            $request->file->move(public_path($path), $imageName);

            DB::table('product-images')->insert([
                'product_id' => DB::select("show table status like 'products'")[0]->Auto_increment,
                'image' => $imageName,
                'path' => $path
            ]);

        return response()->json(['success'=>$imageName]);


    }
    public function store(Request $request)
    {


        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:products'],
            'category_id' => 'required' ,
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
        ]);
        try {
            DB::beginTransaction();


            // DB::table('attribuites')->insert([
            //     'product_id'=> DB::select("show table status like 'products'")[0]->Auto_increment,
            //     'weight'=>$request->weight,
            //     'qty'=>$request->qty,
            // ]);

            $file_name = $this->uploadImage($request->image ,'image/products/' );
//            Crud::store($this->table , $request->except('_token'));
            DB::table('products')->insert([
                'sku' => rand(),
                'code' => str_replace(' ','-',$request->name),
                'name'=> $request->name,
                'name_ar'=> $request->name_ar,
                'description' => $request->description,
                'category_id'=> $request->category_id,
                'subcategory_id'=> $request->subcategory_id,
                'brand_id'=> $request->brand_id,
                'price'=> $request->price,
                'tax' => $request->tax,
                'discount' => $request->discount,
                'image' => $file_name,
                'entry' => Auth::user()->name,
            ]);


            DB::commit();


            return redirect()->route('product.index')->with('status', 'Successfully Added');


        }catch (Throwable $e){
            report($e);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Crud::multiUpdate($this->model ,\request('item') , ['deleted_at' => Carbon::now()]);
        return redirect()->route('product.index')->with('status', 'Successfully Deleted');
    }

    public function getSubCategory(Request $request){
        if($request->ajax()){
            $data = Category::with('Subcategory')->select()->where('id' , $request->id)->get();
            $output = '';
            // IF DATA FOUND
            if($data->count() > 0 ){
                // Sub category
                $output ='<div class="form-group">
                <label for="subcategory_id" class="col-md-4 col-form-label text-md-right">sub category</label>

                <div class=" col-md-6">
                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                    <option value="" selected disabled>Choose Sub Category</option>';

                foreach ($data as $subcategories)
                    foreach ($subcategories->subcategory as $subcategory)
                        if (LaravelLocalization::getCurrentLocale() == 'en'){
                        $output .= '<option value="'.$subcategory->id.'"> '.$subcategory->name.'</option>';
                        }else{
                            $output .= '<option value="'.$subcategory->id.'"> '.$subcategory->name_ar.'</option>';
                        }
                $output.='</select>
            </div>
        </div>';
            }
            // No DATA FOUND
            else{
            }
            return $output;
        }
    }

}
