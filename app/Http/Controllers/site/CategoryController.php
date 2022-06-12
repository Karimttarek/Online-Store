<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crud;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\LaravelLocalization;

class CategoryController extends Controller
{

    public function index(Request $request  , $id)
    {
//        $data = Crud::getDataWithRelationWhere('App\Models\Product', ['Brand'], 'category_id', '=', $id, ['*'] , 'id' , 'desc')->paginate(PAGINATION_COUNT);
        $data = Product::with('Brand')->where('category_id' , $id)
            ->orderBy('id' , 'desc')
            ->select()
            ->paginate(PAGINATION_COUNT);
        if($data->isEmpty())
            return redirect()->back();
        else

        $brands = collect(Crud::getDataWithRelationWhere('App\Models\Product', ['Brand'] ,'category_id' ,'=' ,$id, ['*'] ))->unique('brand_id');
        $subcategories = collect(Crud::getDataWithRelationWhere('App\Models\Product', ['Subcategory'] ,'category_id' ,'=' ,$id, ['*'] ))->unique('subcategory_id');
        $spec = collect(Crud::getDataWithRelationWhere('App\Models\Product', ['Spec'] ,'category_id' ,'=' ,$id, ['*'] ))->unique('product_id');

        if ($request->ajax()){
            $view = view('site.productdata', compact('data'))->render();
            return response()->json(['html' => $view]);
        }
        return view('site.category', compact('data', 'brands', 'subcategories'));

    }

    public function filter(Request $request)
    {
        $brands = collect(Crud::getDataWithRelationWhere('App\Models\Product', ['Brand'] ,'category_id' ,'=' ,$request->id, ['*'] ))->unique('brand_id');
        $subcategories = collect(Crud::getDataWithRelationWhere('App\Models\Product', ['Subcategory'] ,'category_id' ,'=' ,$request->id, ['*'] ))->unique('subcategory_id');
        if ($request->ajax()) {

            if (empty($request->brand_id) && empty($request->subcategory_id)){
                $data = Product::
                    where('category_id' , $request->id)
                    ->where('price' ,'>=',$request->pricefrom)
                    ->where('price' , '<=' ,$request->priceto)
                    ->orderBy('id' ,'desc')
                    ->select()
                    ->paginate(PAGINATION_COUNT);
            }
            elseif(empty($request->brand_id)){
                $data = Product::where('category_id' , $request->id)
                    ->where('price' ,'>=',$request->pricefrom)
                    ->where('price' , '<=' ,$request->priceto)
                    ->whereIn('subcategory_id' ,$request->subcategory_id)
                    ->orderBy('id' ,'desc')
                    ->select()
                    ->paginate(PAGINATION_COUNT);
            }
            elseif(empty($request->subcategory_id)){
                $data = Product::where('category_id' , $request->id)
                    ->where('price' ,'>=',$request->pricefrom)
                    ->where('price' , '<=' ,$request->priceto)
                    ->whereIn('brand_id' ,$request->brand_id)
                    ->orderBy('id' ,'desc')
                    ->select()
                    ->paginate(PAGINATION_COUNT);
            }
            else{
                $data = Product::where('category_id' , $request->id)
                    ->where('price' ,'>=',$request->pricefrom)
                    ->where('price' , '<=' ,$request->priceto)
                    ->whereIn('brand_id' ,$request->brand_id)
                    ->whereIn('subcategory_id' ,$request->subcategory_id)
                    ->orderBy('id' ,'desc')
                    ->select()
                    ->paginate(PAGINATION_COUNT);
            }


            if ($data->count() > 0) {
                $output = '<div class="row">';
                foreach ($data as $product)
                    $output .= '<div class="card-body b-1">
                            <div class="row g-0">
                                <div class="col-md-3 b-r-1">
                                    <a href="'.route('productDetail',$product->id).'">
                                        <img src="' . URL::asset('image/products/'  . $product->image) . '" alt="" class="bd-placeholder-img bd-placeholder-img-lg img-fluid" style="max-height: 250px">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                    <h5 class="">
                                    '.$product->name.'
                                    </h5>
                                    <p class="">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class=""><small class="text-muted">'.$product->brand->name.'</small></p>
                                                    <h5 class="text-primary text-bold">'.$product->price.'</h5>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-default shadow-sm">
                                                        <a href="'.route('productDetail',$product->id).'" class="text-gray">VIEW FULL DETAILS</a>
                                                    </button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
            // No DATA FOUND
            return $output;
        }
    }
}
