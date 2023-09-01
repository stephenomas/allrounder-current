<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CkdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\NumberPlateController;

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

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'login'])->name('signin');
Route::get('/add-products', [ProductController::class, 'tricyclecreate'])->middleware('addproduct');
Route::get('/brand/{brand}/', [ProductController::class, 'brandsel'])->middleware('addproduct');
Route::post('/add-products', [ProductController::class, 'store'])->middleware('addproduct');
Route::get('/view-products', [ProductController::class, 'index'])->middleware('viewproduct')->name('viewproducts');
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->middleware('viewproduct');
Route::put('/edit-product/{id}', [ProductController::class, 'update'])->middleware('viewproduct');
Route::get('/edit-product/{product}/delete', [ProductController::class, 'destroy'])->middleware('viewproduct');
Route::get('/view-inventory', [ProductController::class, 'inventory'])->middleware('viewproduct')->name('inventory');
Route::get('/sold-products', [ProductController::class, 'sold'])->middleware('viewproduct')->name('soldproducts');
Route::get('/view-stats', [ProductController::class, 'stats'])->middleware('viewproduct');

Route::get('/new-sale', [SalesController::class, 'create'])->middleware('newsale');
Route::get('/new-sale-ckd', [SalesController::class, 'ckd_view'])->middleware('newsale');
Route::post('/new-sale-ckd', [SalesController::class, 'ckd_sale'])->middleware('newsale');
Route::post('/addtocart', [SalesController::class, 'addcart'])->middleware('newsale');
Route::get('/removecart/{id}', [SalesController::class, 'removecart'])->middleware('newsale');
Route::get('/buyer-details', [SalesController::class, 'buyer'])->middleware('newsale');
Route::post('/buyer-details', [SalesController::class, 'buyersave'])->middleware('newsale');
Route::resource( '/sales-list',SalesController::class)->middleware('saleslist');
Route::get( '/sales-report',[SalesController::class, 'report_index'])->middleware('saleslist');
Route::get('/sales-list/delete/{sales}', [SalesController::class, 'delete'])->name('sales-list.delete');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('adduser');
Route::post('/user/create', [UserController::class, 'store'])->name('user.store')->middleware('adduser');
Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('viewuser');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('viewuser');
Route::patch('/user/{id}/edit', [UserController::class, 'update'])->name('user.update')->middleware('viewuser');
Route::get('/user/{user}/delete', [UserController::class, 'delete'])->name('user.delete')->middleware('viewuser');

Route::get('/add-branch', [BranchController::class, 'create'])->middleware('addbranch');
Route::post('/add-branch', [BranchController::class, 'store'])->middleware('addbranch');
Route::get('/view-branches', [BranchController::class, 'index'])->middleware('viewbranch');
Route::get('/branch/{branch}/edit', [BranchController::class, 'edit'])->middleware('viewbranch');
Route::put('/branch/{branch}/edit', [BranchController::class, 'update'])->middleware('viewbranch');
Route::get('/branch/{branch}/delete', [BranchController::class, 'destroy'])->middleware('viewbranch');

Route::get('/add-report', [ReportController::class, 'create'])->middleware('addreport');
Route::post('/add-report', [ReportController::class, 'store'])->middleware('addreport');
Route::get('/view-outgoing', [ReportController::class, 'outindex'])->middleware('viewreport');
Route::get('/view-incoming', [ReportController::class, 'inindex'])->middleware('viewreport');
//Route::get('/report/{report}/edit', [ReportController::class, 'edit'])->middleware('viewreport');
Route::get('/report/{report}/read', [ReportController::class, 'read'])->middleware('viewreport');
//Route::put('/report/{report}/edit', [ReportController::class, 'update'])->middleware('viewreport');
Route::get('/report/{report}/delete', [ReportController::class, 'destroy'])->middleware('viewreport');


Route::get('/add-brand', [ProductController::class, 'createbrand'])->middleware('addbrand');
Route::post('/add-brand', [ProductController::class, 'storebrand'])->middleware('addbrand');
Route::get('/view-brand', [ProductController::class, 'indexbrand'])->middleware('addbrand');
Route::get('/edit-brand/{brand}/edit', [ProductController::class, 'editbrand'])->middleware('addbrand');
Route::put('/edit-brand/{brand}/edit', [ProductController::class, 'updatebrand'])->middleware('addbrand');
Route::get('/edit-brand/{brand}/delete', [ProductController::class, 'deletebrand'])->middleware('addbrand');


Route::get('/add-model', [ProductController::class, 'createmodel'])->middleware('addspec');
Route::post('/add-model', [ProductController::class, 'storemodel'])->middleware('addspec');
Route::get('/view-model', [ProductController::class, 'indexmodel'])->middleware('editspec');
Route::get('/view-model/{spec}/edit', [ProductController::class, 'editmodel'])->middleware('editspec');
Route::put('/view-model/{spec}/edit', [ProductController::class, 'updatemodel'])->middleware('editspec');
Route::get('/view-model/{spec}/delete', [ProductController::class, 'deletemodel'])->middleware('editspec');

Route::get('/settings', [UserController::class, 'showadmin']);
Route::post('/settings', [UserController::class, 'updateadmin']);


Route::get('/', function(){
   return redirect('/login');
});



Route::get('/dashboard', [UserController::class, 'dashboard'] )->middleware(['auth','dashboard'])->name('dashboard');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');


///number plate
Route::get('/add-number', [NumberPlateController::class, 'create'])->middleware('addnumber');
Route::post('/add-number', [NumberPlateController::class, 'store'])->middleware('addnumber');
Route::get('/number-list', [NumberPlateController::class, 'index'])->middleware('numberlist');
Route::get('/number-list/{id}/{numberplate}/delete', [NumberPlateController::class, 'delete'])->middleware('numberlist');

Route::middleware('addproduct')->group(function (){
    Route::get('/add-ckd', [CkdController::class, 'create']);
    Route::post('/add-ckd', [CkdController::class, 'save']);
});

Route::middleware('viewproduct')->group(function (){
    Route::get('/view-ckd', [CkdController::class, 'index'])->name('viewckd');
    Route::get('/ckdhistory', [CkdController::class, 'history']);
    Route::get('/edit-ckd/{ckd}/edit', [CkdController::class, 'edit']);
    Route::post('/edit-ckd/{ckd}/edit', [CkdController::class, 'update']);
    Route::get('/edit-ckd/{ckd}/delete', [CkdController::class, 'delete']);
});

Route::middleware(['auth', 'warehouse'])->group(function(){
    Route::get('/transfer-ckd', [WarehouseController::class, 'transfer_ckd_create']);
    Route::post('/transfer-ckd', [WarehouseController::class, 'submit_transfer_ckd']);
    Route::get('/transfer-cbu', [WarehouseController::class, 'transfer_cbu_create']);
    Route::post('/transfer-cbu', [WarehouseController::class, 'submit_transfer_cbu']);
    Route::get('/warehouse-incoming', [WarehouseController::class, 'incoming']);
    Route::post('/warehouse-incoming', [WarehouseController::class, 'incoming_save']);
    Route::get('/warehouse-transfers', [WarehouseController::class, 'index_transfers']);
    Route::get('/warehouse-transfers/{warehouse}', [WarehouseController::class, 'view_transfer']);
    Route::get('/warehouse-transfers/{warehouse}/edit', [WarehouseController::class, 'edit_transfer']);
    Route::post('/warehouse-transfers/{warehouse}/edit', [WarehouseController::class, 'save_transfer']);
    Route::get('/warehouse-transfers/{warehouse}/delete', [WarehouseController::class, 'delete_transfer']);
});

Route::get('/cron-jobs/sendsalereport', [SalesController::class, 'send_sales_report']);
Route::get('/mail-template', function(){
    return view('mail.newsales-mail');
});

Route::prefix('inventory')->name('inventory.')->group(function(){
    Route::get('populate', [InventoryController::class, 'populate']);
    Route::middleware(['auth'])->group(function (){
        Route::get('search', [InventoryController::class, 'search'])->name('search');
        Route::get('added', [InventoryController::class, 'addition'])->name('added');
    });

});
// Route::get('/populate', [ProductController::class, 'populate']);
require __DIR__.'/auth.php';
