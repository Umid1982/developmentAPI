<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
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

Route::prefix('v1')->group(function () {
    // USER CRUD
    Route::resource('users', UserController::class);

    //COMMENTS FOR COMPANY
    Route::get('company_comments/{company}',[CompanyController::class,'comments']);

    //COMPANY VALUATION
    Route::get('company_valuation/{company}',[CompanyController::class,'companyValuation']);
    //TOP COMPANIES
    Route::get('companies/top',[CompanyController::class,'companyTop']);

    //COMPANY CRUD
    Route::resource('companies', CompanyController::class);
    //COMMENT CRUD
    Route::resource('comments', CommentController::class);
});
