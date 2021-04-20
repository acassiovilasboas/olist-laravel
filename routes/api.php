<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\StatesOfBrazilController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['throttle:10,1'], 'as' => 'api.'], function () {

    Route::apiResources([
        '/product' => ProductController::class,
        '/category' => CategoryController::class
    ]);

    Route::apiResource('/states-of-brazil', StatesOfBrazilController::class)->only('index', 'store', 'show');

});

Route::fallback(function() {
   return response()->json(['message' => 'Pagina não encontrada'], 404);
});

