<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Models\Copy;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/copies', CopyController::class);
Route::apiResource('/books', BookController::class);

Route::middleware('auth.basic')->group(function () {

    Route::apiResource('/users', UserController::class);
    //Lekérdezések
    Route::get('lending_by_user', [UserController::class, 'lendingByUser']);
    Route::get('all_lending_user_copy', [LendingController::class, 'allLendingUserCopy']);
    Route::get('osszes_kolcsonzes/{keresettDatum}', [LendingController::class, 'osszesKolcsonzes']);
    Route::get('adott_kolcsonzes_peldany/{keresettID}', [LendingController::class, 'adottKolcsonzesPeldany']);
    Route::get('harmadik', [LendingController::class, 'harmadik']);
});

Route::get('/lendings', [LendingController::class, 'index']);
Route::get('/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'show']);
//Route::put('/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'update']);
Route::post('/lendings', [LendingController::class, 'store']);
Route::delete('/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'destroy']);

//egyéb végpontok
Route::patch('/user_update_password/{id}', [UserController::class, 'updatePassword']);
