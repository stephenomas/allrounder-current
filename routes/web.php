<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
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
Route::get('/view-products', [ProductController::class, 'index'])->middleware('viewproduct');
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->middleware('viewproduct');
Route::put('/edit-product/{id}', [ProductController::class, 'update'])->middleware('viewproduct');
Route::get('/edit-product/{product}/delete', [ProductController::class, 'destroy'])->middleware('viewproduct');
Route::get('/view-inventory', [ProductController::class, 'inventory'])->middleware('viewproduct');
Route::get('/view-stats', [ProductController::class, 'stats'])->middleware('viewproduct');

Route::get('/new-sale', [SalesController::class, 'create'])->middleware('newsale');
Route::post('/addtocart', [SalesController::class, 'addcart'])->middleware('newsale');
Route::get('/removecart/{id}', [SalesController::class, 'removecart'])->middleware('newsale');
Route::get('/buyer-details', [SalesController::class, 'buyer'])->middleware('newsale');
Route::post('/buyer-details', [SalesController::class, 'buyersave'])->middleware('newsale');
Route::resource( '/sales-list',SalesController::class)->middleware('saleslist');

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

Route::get('/settings', [UserController::class, 'showadmin'])->middleware('adminmid');
Route::post('/settings', [UserController::class, 'updateadmin'])->middleware('adminmid');


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


require __DIR__.'/auth.php';
