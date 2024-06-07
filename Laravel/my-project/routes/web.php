<?php

use Illuminate\Support\Facades\Route;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/testmodel', function(){
    $test = Test::findOrFail(1);
    dd($test);
});


Route::get('/testuser',function(){
    $user = DB::table('users')->where ('id',1)->first();
    dd($user);
});

// Route for list category
Route::get('/categories', [CategoryController::class, 'index'])->name("category.list");

// Route for create category
Route::get('/category/create',[CategoryController::class, 'create'])->name("category.create");
Route::post('/category', [CategoryController::class, 'store'])->name("category.store");

// Route for edit Category
Route::get('/category/{categoryId}/edit',[CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{categoryId}', [CategoryController::class, 'update'])->name('category.update');

// Route for Delete category
Route::delete('/category/{categoryId}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/category/{cateId}', [CategoryController::class, 'show'])->name('category.show');


