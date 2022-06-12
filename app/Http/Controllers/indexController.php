<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Crud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\LaravelLocalization;

class indexController extends Controller
{
    protected $cartCount = '';
    //
    public function index(){
        $categories = Crud::getDataWhere('categories' , 'deleted_at' , null ,['id' , 'name' ,'name_ar' , 'image']);
        $products = Crud::getDataWhere('products' ,'deleted_at' , null , ['name' ,'name_ar' , 'id' , 'image' ,'price']);
        $latestproducts = DB::table('products')->where('deleted_at' , null)
            ->orderBy('id' , 'desc')
            ->select('name','name_ar' , 'id' , 'image','price')->paginate(12);
        if (!empty(Auth::user()->name)){
            $cartCount = Cart::where('user' , Auth::user()->name)->count();
            return view('index' , compact('categories' , 'products','latestproducts' , 'cartCount'));
        }else{
            return view('index' , compact('categories' , 'products','latestproducts'));
        }
    }

    public function searchMenu(Request $request){

        if ($request->ajax()){
            $data = DB::table('products')
                ->where('deleted_at' , null)
                ->where('name' , 'LIKE' , '%'.$request->data.'%')
                ->orWhere('name_ar' , 'LIKE' , '%'.$request->data.'%')
                ->select('id','name','name_ar')->get();

            if ($data->count() > 0){
                $output = '<div class="row">';
                foreach ($data as $product){
                    $output .= '<div class="col-11 hover flex-l">';
                    if (\LaravelLocalization::getCurrentLocale() == 'en'){
                        $output.=  '<a href="'.route('productDetail',$product->id).'" class="m-1 link-dark col-12">'.$product->name.'</a></div>';
                    }else{
                        $output.=  '<a href="'.route('productDetail',$product->id).'" class="m-1 link-dark">'.$product->name_ar.'</a></div>';
                    }
                }
                $output .= '</div>';
                return $output ;
            }elseif ($data == null){
                return null;
            }
            else{
                return '<div><div><i class="fas fa-ban m-1"> </i> No result found ...</div></div>';
            }
        }
    }
}
