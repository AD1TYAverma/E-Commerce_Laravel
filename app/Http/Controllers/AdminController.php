<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function addCategory(){
        return view('admin.addcategory');
    }

    public function postAddCategory(Request $request){
        $category=new Category();
        $category->category=$request->category;
        $category->save();
        return redirect()->back()->with('msg', 'Category Added Successfully');
    }

    public function viewCategory(){
        $category = Category::all();
        return view('admin.viewcatrgory', compact('category'));
    }


    public function deleteCategory($id){
        Category::find($id)->delete();
        return back()->with('msg', 'Category Deleted Successfully');
    }

    // Edit page
    public function editCategory($id)
    {
        $cat = Category::find($id);
        return view('admin.edit_category', compact('cat'));
    }

// Update data
    public function updateCategory(Request $request, $id)
    {
        $cat = Category::find($id);

        $cat->category = $request->category;
        $cat->save();

        return redirect()->route('admin.viewcatrgory')->with('msg', 'Category Updated Successfully');
    }

    public function addProduct(){
        $category= Category::all();
        return view('admin.addproduct', compact('category'));
    }

    public function postAddproduct(Request $request){
        $product = new Product();

        // $image=$request->product_img;
        // if($image){
        //     $imagename = time().'.'.$image->getClientOriginalExtension();
        //     $product->product_img=$imagename;
        // }
        $file = $request->file('product_img');

        $filename = time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('products'), $filename);

        $product->product_img = $filename;

        $product->save();

        $product->product_title=$request->product_title;
        $product->product_description=$request->product_description;
        $product->product_quantity=$request->product_quantity;
        $product->product_prices=$request->product_prices;
        $product->product_category=$request->product_category;

        $product->save();

        // if($file && $product->save()){
        //     $request->product_img->move('products', $file);
        // }
        return redirect()->back()->with('msg', 'Product Added Successfully');
    }

    public function viewProduct(){
        $product = Product::paginate(3);
        return view('admin.viewproduct', compact('product'));
    }

    // public function deleteProduct($id){
    //     Product::find($id)->delete();
    //     $image_path = public_path('products/'.$product->product_img);
    //     return back()->with('msg', 'Category Deleted Successfully');
    // }

    public function deleteProduct($id){
    $product = Product::find($id); // 👈 पहले data लो
    // Image delete
    if($product && $product->product_img){
        $image_path = public_path('products/'.$product->product_img);
        if(file_exists($image_path)){
            unlink($image_path); // 👈 file delete
        }
    }
    // Database से delete
    $product->delete();
    return back()->with('msg', 'Product Deleted Successfully');
}

    // Edit page
    public function editProduct($id)
    {
        $prod = Product::find($id);
        $product = Category::all();
        return view('admin.editproduct', compact('prod','product'));
    }

// Update data
//     public function updateProduct(Request $request, $id)
//     {
//         $prod = Product::find($id);

//         $prod->product_img = $request->product_img;
//         $prod->product_title = $request->product_title;
//         $prod->product_description = $request->product_description;
//         $prod->product_quantity = $request->product_quantity;
//         $prod->product_prices = $request->product_prices;
//         $prod->product_category = $request->product_category;
//         $prod->save();

        

//         return redirect()->route('admin.viewproduct')->with('msg', 'Category Updated Successfully');

// }

public function updateProduct(Request $request, $id)
{
    $prod = Product::find($id);

    // Check new image uploaded
    if($request->hasFile('product_img')){

        // Old image delete
        $oldPath = public_path('products/'.$prod->product_img);
        if(File::exists($oldPath)){
            File::delete($oldPath);
        }

        // New image upload
        $file = $request->file('product_img');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('products'), $filename);

        // Save new image name
        $prod->product_img = $filename;
    }

    // Other fields update
    $prod->product_title = $request->product_title;
    $prod->product_description = $request->product_description;
    $prod->product_quantity = $request->product_quantity;
    $prod->product_prices = $request->product_prices;
    $prod->product_category = $request->product_category;

    $prod->save();

    return redirect()->route('admin.viewproduct')->with('msg', 'Product Updated Successfully');
}

public function searchProduct(Request $request){
    $product = Product::where('product_title', 'LIKE', '%'.$request->search.'%')
    ->orWhere('product_category', 'LIKE', '%'.$request->search.'%')
    ->paginate(2);
    return view('admin.viewproduct', compact('product'));
}

public function viewOrders(){
    $orders=Order::all();
    return view('admin.vieworders', compact('orders'));
}



public function changeStatus(Request $request, $id){
    $request->validate([
        'status' => 'required'
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('msg', 'Status Updated');
}

public function downloadpdf($id){
    $data = Order::findOrFail($id);
    $pdf = Pdf::loadView('admin.invoice', compact('data'));
    return $pdf->download('invoice.pdf');
}


}