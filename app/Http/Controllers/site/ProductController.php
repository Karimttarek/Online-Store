<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crud;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart as CartLib;

class ProductController extends Controller
{

    protected $table = 'products';
    protected $model = 'App\Models\Product';

    public function productDetail($id)
    {
        $data = Crud::getDataWithRelationWhereId($this->model, ['Spec' ,'Images','Attribuite'], ['*'], $id);

        foreach ($data as $category) {
            $products = DB::table('products')->where('category_id' , $category->category_id)->select('id','name' , 'name_ar' ,'image' , 'price')->paginate(6);
        }

        if (!empty(Auth::user()->name)){
            $wishlists = DB::table('wishlist')->where('product_id' ,$id)->where('user',Auth::user()->name)->select('id')->get();
            $cart = DB::table('cart')->where('product_id' ,$id)->where('user',Auth::user()->name)->select('id')->get();
            return view('site.productdetail', compact('data', 'products','wishlists','cart'));
        }else{
            return view('site.productdetail', compact('data', 'products'));
        }

    }

    public function allProducts(){
        $data = DB::table('products')->where('deleted_at' , null)
            ->orderBy('id' , 'desc')
            ->select('id','code','name' , 'name_ar' , 'description' ,'image','price' , 'stock')
            ->paginate();
        return view('site.allproducts',compact('data'));
    }

    public function addToCart(Request $request){

        if ($request->ajax()){
            $data = DB::table('cart')->where('product_id' , $request->id)->where('user' , Auth::user()->name)->get();
            if ($data->count() <= 0){

                Crud::store('cart' , [
                    'product_id' => $request->id,
                    'user'=>Auth::user()->name,
                    'qty' => $request->qty,
                    'cost'=>$request->cost,
                    'total'=>$request->qty*$request->cost,
                ]);

                $message = 'Added to Cart';
                return $message;
            }else{
                $message = 'Already in your Cart';
                return $message;
            }
        }
    }

    public function wishlist(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('wishlist')->where('product_id' , $request->id)->where('user' , Auth::user()->name)->get();
            if ($data->count() <= 0){

                Crud::store('wishlist' , [
                    'product_id' => $request->id,
                    'user'=>Auth::user()->name,
                    'qty' => $request->qty,
                    'cost'=>$request->cost,
                ]);

                $message = 'Added to wishlists';
                return $message;
            }else{
                Wishlist::where('product_id' , $request->id)->where('user' , Auth::user()->name)->delete();
                $message = 'Removed from wishlists';
                return $message;
            }
        }
    }

    
}
