<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', [UserController::class, 'home'])->name('index');

Route::get('/product_detalis/{id}', [UserController::class, 'productDetalis'])->name('product_detalis');

Route::get('/allproducts', [UserController::class, 'allProducts'])->name('viewallproducts');

Route::get('/cartproducts', [UserController::class, 'cartProducts'])->name('cartproducts');



Route::get('/dashboard',[UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/addtocart/{id}',[UserController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('add_to_cart');

Route::get('/myorders',[UserController::class, 'myOrders'])->middleware(['auth', 'verified'])->name('myorders');


Route::get('/removecartproduct/{id}',[UserController::class, 'removeCartProduct'])->middleware(['auth', 'verified'])->name('removecartproduct');

Route::post('/confirm_order',[UserController::class, 'confirmOrder'])->middleware(['auth', 'verified'])->name('confirm_order');







Route::get('/checkout', [UserController::class, 'checkout'])->name('checkout');
Route::post('/payment-success', [UserController::class, 'paymentSuccess'])->name('payment.success');
Route::match(['get','post'], '/payment-success', [UserController::class, 'paymentSuccess'])->name('payment.success');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcatrgory');  
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategoty');  
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcatrgory');  
     
    Route::delete('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categorydelete');

    // Edit form open karne ke liye
    Route::get('/edit_category/{id}', [AdminController::class, 'editCategory'])->name('admin.editcategory');

    // Update data save karne ke liye
    Route::put('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');

    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct'); 

    Route::post('/add_product', [AdminController::class, 'postAddproduct'])->name('admin.postaddproduct');
    Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');

    Route::delete('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.productdelete');

    // Edit form open karne ke liye
    Route::get('/edit_product/{id}', [AdminController::class, 'editProduct'])->name('admin.editproduct');

    // Update data save karne ke liye
    Route::put('/update_product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');

    Route::post('/search', [AdminController::class, 'searchProduct'])->name('admin.searchproduct');

    Route::get('/vieworders', [AdminController::class, 'viewOrders'])->name('admin.vieworders');
    Route::post('/change_status/{id}', [AdminController::class, 'changeStatus'])->name('admin.change_status');

    Route::get('/downloadpdf/{id}', [AdminController::class, 'downloadpdf'])->name('admin.downloadpdf');

});

require __DIR__.'/auth.php';
