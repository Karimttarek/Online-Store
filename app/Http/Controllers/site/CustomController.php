<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crud;
use App\Models\BillingHeader;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Cart;


class CustomController extends Controller
{


    public function index(){
    }

    public function cartPage(){
        if (empty(Auth::user()->name)){
            $products = collect();
            return view('site.cart' , compact('products'));
        }else{
            $products =  Crud::getDataWithRelationWhere('App\Models\Cart' , ['Product'] , 'user' , '=' , Auth::user()->name , ['*']);

            return view('site.cart' , compact('products' ));
        }
    }

    public function updateCartQuantity(Request $request){

        if ($request->ajax()){
            \App\Models\Cart::where('user' , Auth::user()->name)->where('product_id' , $request->id)
                ->update([
                    'qty' => $request->qty,
                    'total'=>$request->qty * $request->price,
                ]);
            $message = '';
            return $message;
        }

    }

    public function deleteCart(Request $request){
        if ($request->ajax()){
           Crud::deleteWhere('App\Models\Cart' , 'product_id' , '=' , $request->id);
           $message = 'Deleted from carts';
           return $message;
        }
    }

    public function checkout(){
        if (empty(Auth::user()->name)){
            $products = collect();
            return view('site.checkout' , compact('products'));
        }else{
            $products =  Crud::getDataWithRelationWhere('App\Models\Cart' , ['Product'] , 'user' , '=' , Auth::user()->name , ['*']);
            return view('site.checkout' , compact('products'));
        }
    }

    public function billing(Request $request){
        $products =  Crud::getDataWithRelationWhere('App\Models\Cart' , ['Product'] , 'user' , '=' , Auth::user()->name , ['*']);
        $total = $products->sum('total');
        $rand = rand();
//        try {
            DB::beginTransaction();

            DB::table('billingheader')->insert([
                'genkey' => $rand,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'country' => $request->country,
                'city' => $request->city,
                'address' =>$request->address,
                'phone' =>$request->phone,
                'hdrSubTotal' =>$total,
                'hdrTotal' =>$total,
                'created_at' => Carbon::now(),
            ]);
            foreach ($products as $product) {
                DB::table('billingdetails')->insert([
                    'hdrId' => $rand,
                    'product_id' => $product->product->id,
                    'product_name' => $product->product->name,
                    'qty' => $product->qty,
                    'price' => $product->product->price,
                    'productTax' => $product->product->tax,
                    'productDiscount' => $product->product->discount,
                    'total' => $product->qty * $product->product->price,

                ]);
            }

            Crud::deleteWhere('App\Models\Cart', 'user' , '=' , Auth::user()->name);
            DB::commit();

            return redirect()->route('checkout')->with('status', 'Your Billing Has submitted');
//        }catch (\Throwable $e){
//            report($e);
            DB::rollBack();
//        }
    }
}
