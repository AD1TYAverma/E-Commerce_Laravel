<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Order;

use Razorpay\Api\Api;

use function Pest\Laravel\delete;

class UserController extends Controller
{
   public function index(){
        if(Auth::Check() && Auth::user()->user_type=="user" ){
            return view('dashboard');
            }else if(Auth::Check() && Auth::user()->user_type=="admin"){
                return view('admin.dashboard');
            }
        }
        
    public function home(){
        if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
        }else{
            $count= '';
        }
        
        $products = Product::latest()->take(4)->get();
        return view('index', compact('products', 'count'));
    }

    public function productDetalis($id){
        if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
        }else{
            $count= '';
        }
        $product = Product::findOrFail($id);
        return view('product_details', compact('product', 'count'));
    }

    public function allProducts(){
        if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
        }else{
            $count= '';
        }
         $products = Product::all();
        return view('allproducts', compact('products', 'count'));
    }

    public function addToCart($id){
        $product= Product::findOrfail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id=Auth::id();
        $product_cart->product_id=$product->id;

        $product_cart->save();
        return redirect()->back()->with('msg', 'Added To The Cart');
    }

    public function cartProducts(){
        if(Auth::check()){
            $count = ProductCart::where('user_id', Auth::id())->count();
            $cart = ProductCart::where('user_id', Auth::id())->get();
        }else{
            $count= '';
        }
        return view('viewcartproducts', compact('count', 'cart'));

    }

    public function removeCartProduct($id){
        $cart_product = ProductCart::findOrFail($id);
        $cart_product->delete();
        return redirect()->back();
    }

    public function confirmOrder(Request $request){
        $cart_product_id = ProductCart::where('user_id', Auth::id())->get();
        $address=$request->receiver_address;
        $phone=$request->receiver_phone;
        foreach($cart_product_id as $cart_product ){
            $order = New Order();
            $order->receiver_address=$address;
            $order->receiver_phone=$phone;
            $order->user_id=Auth::id();
            $order->product_id=$cart_product->product_id;
            $order->save();
        }
        $cart=ProductCart::where('user_id', Auth::id())->get();
        foreach($cart as $cart){
            $cart_id =ProductCart::find($cart->id);
            $cart_id->delete();
        }
        
        return redirect()->back()->with('msg', 'Order Comfirmed');
        
    }

    public function myOrders(){
        $orders = Order::where('user_id', Auth::id())->get();
        return view('viewmyorders', compact('orders'));
    }
   

   


    public function checkout(){

    $cart = ProductCart::with('product')->where('user_id', Auth::id())->get();

    $total = 0;
    foreach($cart as $item){
        $total += $item->product->product_prices;
    }

    return view('checkout', compact('cart', 'total'));
}

// public function paymentSuccess(Request $request)
// {
//     $payment_id = $request->payment_id;

//     $address = session('receiver_address');
//     $phone = session('receiver_phone');

//     if(!$payment_id){
//         return redirect()->route('checkout')->with('error', 'Payment Failed');
//     }

//     $cart = ProductCart::where('user_id', Auth::id())->get();

//     foreach($cart as $item){
//         $order = new Order();
//         $order->receiver_address = $address;
//         $order->receiver_phone = $phone;
//         $order->user_id = Auth::id();
//         $order->product_id = $item->product_id;
//         $order->payment_status = "paid";
//         $order->payment_id = $payment_id;
//         $order->save();
//     }

//     ProductCart::where('user_id', Auth::id())->delete();

//     return redirect()->route('index')->with('msg', 'Order Placed Successfully');
// }

public function paymentSuccess(Request $request)
{
    $payment_id = $request->payment_id;

    // ✅ request से data लो (session नहीं)
    $address = $request->receiver_address;
    $phone = $request->receiver_phone;

    // safety check
    if(!$address || !$phone){
        return redirect()->route('checkout')->with('error', 'Address missing');
    }

    $cart = ProductCart::where('user_id', Auth::id())->get();

    foreach($cart as $item){
        $order = new Order();
        $order->receiver_address = $address;
        $order->receiver_phone = $phone;
        $order->user_id = Auth::id();
        $order->product_id = $item->product_id;
        $order->payment_status = "paid";
        $order->payment_id = $payment_id;
        $order->save();
    }

    ProductCart::where('user_id', Auth::id())->delete();

    return redirect()->route('index')->with('msg', 'Order Placed Successfully');
}






public function createOrder(Request $request)
{
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $order = $api->order->create([
        'receipt' => 'order_rcptid_11',
        'amount' => 500 * 100, // ₹500 = 50000 paisa
        'currency' => 'INR'
    ]);

    // session में save करो
    session([
        'receiver_address' => $request->receiver_address,
        'receiver_phone' => $request->receiver_phone,
        'razorpay_order_id' => $order['id']
    ]);

    return view('payment', compact('order'));
}


}
