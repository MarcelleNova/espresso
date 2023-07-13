<?php

use App\Http\Controllers\CallsController;
use App\Models\Calls\CallImports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Foreach_;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect(route('home'));
});

Route::get('mobile', function () {
    return view('mobile_home');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('', 'HomeController@index')->name('home');
Route::get('mobile', 'HomeController@mobile')->name('mobile');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/assets/search', 'AssetsController@search')->name('assets.search');
    Route::resource('/assets', 'AssetsController')->middleware('role:Power User|Company Administrator|Super Admin');
    Route::resource('/asset_categories', 'AssetCategoriesController')->middleware('role:Power User|Company Administrator|Super Admin');
    // Route::get('/users/search', 'UserController@search')->name('users.search');
    // Route::resource('/users', 'UserController')->middleware('role:Company Administrator|Super Admin');
   
    Route::resource('/permissions', 'PermissionsController')->middleware('role:Super Admin');
    Route::resource('/roles', 'RolesController');
    Route::resource('/maintenance', 'MaintenanceController')->middleware('role:Power User|Company Administrator|Super Admin');
    Route::resource('/stationery', 'StationeryTemplatesController')->middleware('role:Power User|Company Administrator|Super Admin');
});

Route::prefix('calls')->group(function() {
    //The form to select the zip file
    Route::get("/zip-form",'App\Http\Controllers\calls\ZipController@createJob')->name('zip.create');
    //Route for unzip Button
    Route::post("/unzip",'App\Http\Controllers\calls\ZipController@unzip');
    Route::get("/import",'App\Http\Controllers\calls\ZipController@create')->name('import');
    Route::post("/store",'App\Http\Controllers\calls\ZipController@store')->name('store');
    Route::post("/chunk",'App\Http\Controllers\calls\ZipController@chunk')->name('chunk');
    Route::get("/upload",'App\Http\Controllers\CallsController@upload')->name('import-calls'); 
});

Route::get('/import-calls-do', function() {
    (new CallImports())->importToDB();
    // dd('done');
    return back();
});

Route::get('/salesimport',[App\Http\Controllers\sales\SalesController::class, 'salesCost']);


Route::resource('/users','UserController');

// Route::view('/docs','/docs')->name('docs');
// Route::get('/docs')->name('docs');


Auth::routes();

// Route::get('upload', function() {
//     return view('calls.upload-file');
// });

// Route::get('/upload', [CallsController::class, 'index']);
// Route::post('/uploads', [CallsController::class, 'store']);