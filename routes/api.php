<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BranchController, CourseController, QualificationController, InquiryController};

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
Route::controller(BranchController::class)->prefix('branch')->group(function () {
    Route::get("/list", "getList")->name("branch.list");
    Route::get('/{branch}', 'show')->name('branch.show');
    Route::post('/', 'store')->name('branch.save');
    Route::get('/', 'index')->name('branch.index');
    Route::put('/{branch}', 'update')->name('branch.update');
    Route::delete('/{branch}', 'destroy')->name('branch.destroy');
    Route::post('/bulk-actions','bulkActions')->name('branch.actions');

});

Route::controller(CourseController::class)->prefix('course')->group(function () {
    Route::get('/', 'index')->name('course.list');
    Route::get('/{course}', 'show')->name('course.show');
    Route::post('/', 'store')->name('course.save');
    Route::put('/{course}', 'update')->name('course.update');
    Route::delete('/{course}', 'destory')->name('course.destroy');
});

Route::controller(QualificationController::class)->prefix('qualification')->group(function () {
    Route::get('', 'index')->name('qualification.list');
    Route::get('{qualification}', 'show')->name('qualification.show');
    Route::post('', 'store')->name('qualification.save');
    Route::post('/status/{qualification}', 'updateStatus')->name('qualification.updatestatus');
    Route::put('/{qualification}', 'update')->name('qualification.update');
    Route::delete('{qualification}', 'destory')->name('qualification.destroy');
});

Route::controller(InquiryController::class)->prefix('inquiry')->group(function () {
    Route::get('', 'index')->name('inquiry.list');
    Route::get('{inquiry}', 'show')->name('inquiry.show');
    Route::post('', 'store')->name('inquiry.save');
    Route::post('/status/{inquiry}', 'updateStatus')->name('inquiry.updatestatus');
    Route::put('/{inquiry}', 'update')->name('inquiry.update');
    Route::delete('{inquiry}', 'destory')->name('inquiry.destroy');
});
