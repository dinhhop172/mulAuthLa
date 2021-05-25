<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function viewLogin(){
        return view('customer.login.index');
    }

    public function submitLogin(Request $request){
        $arr = ['name' => $request->name, 'password' => $request->password];
        $succ = Auth::guard('customer')->attempt($arr);
        if($succ){
            return redirect('/shop');
        }
        return redirect('/cus-login')->with('failed', 'Tài khoản hoặc mật khẩu không chính xác');
    }

    public function homePage(){
        return view('customer.login.homepage');
    }
    public function logoutCus(){
        auth()->guard('customer')->logout();
        return back();
    }

    function showProduct(){
        $data = Product::all();
        return view('customer.shop.index', compact('data'));
    }
    function showDetail($id){
        $data = Product::findOrFail($id);
        return view('customer.shop.detail', compact('data'));
    }

    function addCart(Request $request, $id){
        $product = Product::findOrFail($id);
        if(!$product){
            return abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart){
            $cart = [
                $id => [
                    'id' => $id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'desc' => $product->desc,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->route('product.show');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('product.show');
        }else{
            $cart[$id] = [
                    'id' => $id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'desc' => $product->desc,
            ];
            session()->put('cart', $cart);
            return redirect()->route('product.show');
        }
        // echo '<pre>';
        //     print_r(session()->get('cart'));
        // echo '</pre>';
    }

    function showCart(){
        // $carts = session()->get('cart');
        // $total = 0;
        // foreach($carts as $data){
        //     $total += $data['price'] * $data['quantity'];
        // }
        // $carts[]['total'] = $total;
        // sort($carts);
        // return response()->json(['cart'=>$carts, 'total'=>[['total'=>$total]]]);
        // return view('customer.shop.checkout', compact('carts'));
        return view('customer.shop.cart');
    }
    // function updateTotal(){
    //     $carts = session()->get('cart');
    //     $total = 0;
    //     foreach($carts as $data){
    //         $total += $data['price'] * $data['quantity'];
    //     }
    //     return response()->json();
    // }
    function dataCart(){
        $carts = session()->get('cart');
        $total = 0;
        $id = 1;
        foreach($carts as $data){
            $total += $data['price'] * $data['quantity'];
        }
        // rsort($carts);
        // dd($carts);
        // $carts[]['total'] = $total;
        return response()->json(['cart'=>$carts, 'total'=>$total]);
    }

    function deleteItemCart($id){
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return response()->json(session()->get('cart'));
    }

    // function test(Request $request, $id){
    //     $cart = session()->get('cart');
    //     foreach($cart as $data){
    //         dd($data);
    //     }
    //     // session()->put('cart', $cart);
    //     return response()->json($cart);
    // }

    function updateItemCart(Request $request){
        $cart = session()->get('cart');
        $total = 0;
        if($request->idPro){
            $cart[$request->idPro]['quantity'] = $request->quantityy;
        }

        session()->put('cart', $cart);
        return response()->json($cart);
    }
    function showCheckoutCart(){
        $cart = session()->get('cart');
        $total = 0;
        foreach($cart as $item){
            $total += $item['quantity'] * $item['price'];
        }
        return view('customer.shop.checkout', compact('cart', 'total'));
    }

    // function checkoutCart(CheckoutRequest $request){

    // }
    // function addCart(Request $request){
    //     $carts = session()->get('carts');

    //     $id_product = $request->id;

    //     if(!$carts){
    //         $carts = [
    //             $id_product => $request->only('id', 'name', 'image', 'price', 'quantity', 'desc')
    //         ];
    //     }
    //     if(isset($carts[$id_product])){
    //         if($request->quantity == '1'){
    //             $carts[$id_product]['quantity'] = 1;
    //         }else{
    //             $carts[$id_product]['quantity'] += $request->quantity;
    //         }

    //         session()->put('carts', $carts);
    //     }else{
    //         $carts[$id_product] = $request->only('id', 'name', 'image', 'price', 'quantity', 'desc');
    //         session()->put('carts', $carts);
    //     }
    //     echo '<pre>';
    //         print_r($carts);
    //     echo '</pre>';
    // }
}
