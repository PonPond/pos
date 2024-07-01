<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Category;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ListAll;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DebtorsController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\backupController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\PDFController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {

        $qty = DB::table('products')
        ->select(DB::raw('COUNT(id_product ) as total_qty'))
        ->first();

        $category = DB::table('categories')
        ->select(DB::raw('COUNT(id) as total_qty'))
        ->first();

        $debtors = DB::table('debtors')
        ->select(DB::raw('COUNT(id) as total_qty'))
        ->first();

        $price = DB::table('order_products')
        ->select(DB::raw('SUM(price ) as total_qty'))
        ->first();

        $ordernew = DB::table('order_products')
        ->join('products', 'order_products.product_id', 'products.id_product')
        ->join('categories', 'categories.id', 'products.category_id')
        ->select('categories.name',DB::raw('count(products.category_id) as total'))
        ->groupBy('categories.name')
        ->orderBy('total','desc')
        ->simplePaginate(5);

        $dash1 = [];
        $dash1_1 = [];

        foreach ($ordernew as $dash => $values) {
            $dash1[] = $values->name;
        }

        foreach ($ordernew as $dash => $values) {
            $dash1_1[] = $values->total;
        }

       
        $mon =DB::table('order_products')
        ->select(DB::raw("(sum(price)) as priceall"), DB::raw("(DATE_FORMAT(created_at, '%m')) as month"), DB::raw("(DATE_FORMAT(created_at, '%Y')) as year"))
                            ->orderBy('created_at')
                            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m')"),DB::raw("DATE_FORMAT(created_at, '%Y')"))
                            ->get();
                                                  
         $time = date("Y", time()); 
         $timemon = date("m", time()); 

        //  dd($timemon);
        $summon = [];
        $summonall = [];
       
        $allmon = ["01","02","03","04","05","06","07","08","09","10","11","12"];
       
       

         foreach ($mon as $dash => $item) {
           
             if($time == $item->year){
                
                $summon[] = $item->priceall;
             }
        }

      

      
        
    
     

                

         
        return view('dashboard',compact('qty','category','debtors','price','dash1','dash1_1','summon'));
    })->name('dashboard');

    Route::get('/barcode/{id}', 'App\Http\Controllers\BarcodeController@index')->name('home.index');


    Route::get('/shop-mo', [CartController::class, 'mo'])->name('mo');
    Route::get('/shop', [CartController::class, 'cartList'])->name('shopP');
    Route::get('/shopS', [CartController::class, 'cartListS'])->name('shopS');
    
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('carts', [CartController::class, 'addToCartS'])->name('cart.stores');

    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/menu_delete', [ProductController::class, 'indexs'])->name('product.menu_delete');
 
    Route::post('/product/store', [ProductController::class, 'store'])->name('product_store');
    Route::post('/product-update/{id}', [ProductController::class, 'update']);
    Route::get('/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('/product/return/{id}', [ProductController::class, 'return']);
    Route::delete('/products/delete-selected', [ProductController::class, 'deleteSelected'])->name('product.deleteSelected');



    Route::get('/category', [Category::class, 'index'])->name('product.category');
    Route::post('/category/store', [Category::class, 'store'])->name('category_store');
    Route::post('category-update/{id}', [Category::class, 'update']);
    Route::get('/category/delete/{id}', [Category::class, 'delete']);



    Route::get('/payment/delete/{id}', [paymentController::class, 'delete']);


    Route::post('/list/store', [ListAll::class, 'store'])->name('list');
    Route::get('/list', [ListAll::class, 'index'])->name('listindex');
    Route::get('/lists', [ListAll::class, 'indexS'])->name('listindexs');
    Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF1'])->name('showpdf');
    Route::get('generate-pdf2/{id}', [PDFController::class, 'generatePDF2'])->name('showpdf2');
    Route::get('generate-a4/{id}', [PDFController::class, 'generateA4'])->name('showa4');
    
   
    Route::get('/listall/delete/{id}', [ListAll::class, 'delete']);

    Route::get('/debtors', [DebtorsController::class, 'index'])->name('debtors.index');
    Route::post('/debtors/store', [DebtorsController::class, 'store'])->name('debtors_store');
    Route::get('/debtors/{id}', [DebtorsController::class, 'read']);
    Route::post('/debtors/storeId', [DebtorsController::class, 'storeid'])->name('debtors_storeid');
    Route::post('debtors/update/{id}', [DebtorsController::class, 'update']);

    

    Route::get('/dashboard1', [dashboardController::class, 'dash1'])->name('dash1');
    Route::post('/dashboard1/find', [dashboardController::class, 'dash1find'])->name('finddash1');
    Route::get('/our_backup_database', [backupController::class, 'our_backup_database'])->name('our_backup_database');

    Route::get('/user', [UsersController::class, 'index'])->name('user.index');
    Route::get('/user', [UsersController::class, 'index'])->name('user.index');
    Route::post('user-update/{id}', [UsersController::class, 'update']);
 

    Route::get('/refund',[RefundController::class, 'index'])->name('refund.index');
    Route::post('/refund/delete', [RefundController::class, 'addToRefund'])->name('refund.delete');
    // Route::get('/our_backup_database', 'backupController@our_backup_database')->name('our_backup_database');

    // routes/web.php
    
    Route::get('/upload', [FileController::class,'showUploadForm'])->name('upload.form');
    Route::post('/upload', [FileController::class,'upload'])->name('upload');
    Route::get('/download/{id}', [FileController::class,'download'])->name('download');
    
// routes/web.php
    Route::delete('/file/{id}', [FileController::class,'delete'])->name('file.delete');

});
