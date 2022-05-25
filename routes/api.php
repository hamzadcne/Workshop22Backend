<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AgencyAuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/hello',function (){
//     echo 'Hello Laravel';
// });

Route::get('/category', [OffersController::class, 'list']);
//Route::get('/offers/{id}', [OffersController::class, 'show']);

// Route::post('/offer/{id?}', function ($id='offer1') {
//     return 'Post Offer '.$id;
// });
Route::get('/hello',function(){
    return 'hello';
});

Route::apiResource('category', CategoryController::class);
Route::apiResource('offer', OffersController::class);

Route::get('images/{id}',[ImageController::class, 'fetch']);

Route::post('userregister',[UserAuthController::class, 'register']);
Route::post('userlogin',[UserAuthController::class, 'login']);

Route::post('agencyregister',[AgencyAuthController::class, 'register']);
Route::post('agencylogin',[AgencyAuthController::class, 'login']);

Route::middleware('auth:user')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:agency')->get('/agency', function (Request $request) {
    return $request->user();
});