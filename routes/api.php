<?php

use App\Http\Controllers\CategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("categorie")->group(function(){
    Route::post("/store",[CategorieController::class,"store"]);
    Route::get("/",[CategorieController::class,"all"]);
    Route::put("/{categorie}",[CategorieController::class,"update"]);
    Route::delete("/{id}",[CategorieController::class,"delete"]);
    Route::get("/search",[CategorieController::class,"byLibelle"]);
});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
