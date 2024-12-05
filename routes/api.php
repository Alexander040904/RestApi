<?php


use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/', [StudentController::class,'index']);
Route::post('students', [StudentController::class,'store']);
Route::get('students/{id}', [StudentController::class,'show']);
Route::put('students/{id}', [StudentController::class,'update']);
Route::delete('students/{id}', [StudentController::class,'destroy']);
