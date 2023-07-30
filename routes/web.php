<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;


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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/install', function () {
    try{
        if(User::all()->count() == 0){
            return view('app_install');
        }else{
            return redirect(url('/').'/login');
        }
    } catch (\Exception $e) {
        return view('app_install');
    }
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test_functions', function () {
    return view('testing_f');
});

Route::post('/test_functions/submited', function (Request $request) {
    Session::flash('GroupType', $request->importinggroup);
    Excel::import(new UsersImport, $request->file);
})->name('submit_test_form');
