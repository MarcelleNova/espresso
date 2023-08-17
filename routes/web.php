<?php


use App\Repositories\Bitrix;
use App\Models\Calls\CallImports;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('callData','App\Http\Controllers\calls\CallDataController@data')->name('callData');

Route::get('dashboard','App\Http\Controllers\calls\CallDataController@dashboard')->name('dashboard');

// Route::get('', 'HomeController@index')->name('home');
Route::get('mobile', 'HomeController@mobile')->name('mobile');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/assets/search', 'AssetsController@search')->name('assets.search');
    Route::resource('/assets', 'AssetsController')->middleware('role:Power User|Company Administrator|Super Admin');
    Route::resource('/asset_categories', 'AssetCategoriesController')->middleware('role:Power User|Company Administrator|Super Admin');
    Route::get('/users/search', 'UserController@search')->name('users.search');
    // Route::resource('/users', 'UserController')->middleware('role:Company Administrator|Super Admin');
    Route::resource('/users', 'UserController');
    Route::resource('/permissions', 'PermissionsController');
    Route::resource('/venues', 'VenueController');
    Route::resource('/ventures', 'VentureController');
    Route::post('/email', 'App\Http\Controllers\admin\UserController@email')->name('email');
    Route::get('/ventures/getVentures', 'App\Http\Controllers\admin\VentureController@getVentures')->name('ventures.getVentures');
    Route::get('/venues/getVenues', 'App\Http\Controllers\admin\VenueController@getVenues')->name('venues.getVenues');
    Route::get('/bitrix/users', 'App\Http\Controllers\admin\BitrixUserController@index')->name('bitrix.users');
    Route::get('/bitrix/getActiveUsers', 'App\Http\Controllers\admin\BitrixUserController@getActiveUsers')->name('bitrix.getActiveUsers');
    // Route::resource('/permissions', 'PermissionsController')->middleware('role:Super Admin');
    Route::resource('/roles', 'RolesController');
    Route::resource('/maintenance', 'MaintenanceController')->middleware('role:Power User|Company Administrator|Super Admin');
    Route::resource('/stationery', 'StationeryTemplatesController')->middleware('role:Power User|Company Administrator|Super Admin');
});

Route::namespace('calls')->prefix('calls')->name('calls.')->group(function() {
    //The form to select the zip file
    Route::get("/zip-form",'App\Http\Controllers\calls\ZipController@createJob')->name('zip.create');
    //Route for unzip Button
    Route::post("/unzip",'App\Http\Controllers\calls\ZipController@unzip')->name('unzip');
    // Route::get("/import",'App\Http\Controllers\calls\ZipController@create')->name('import');
    Route::post("/store",'App\Http\Controllers\calls\ZipController@store')->name('store');
    Route::post("/chunk",'App\Http\Controllers\calls\ZipController@chunk')->name('chunk'); 
    Route::get("/upload",'App\Http\Controllers\CallsController@upload')->name('import-calls'); 
    Route::put('/phones/doTSRUpdate', 'App\Http\Controllers\calls\PhonesMovementController@doTSRUpdate')->name('phones.doTSRUpdate');
    Route::put('/phones/doExtensionUpdate', 'App\Http\Controllers\calls\PhonesMovementController@doExtensionUpdate')->name('phones.doExtensionUpdate');
    //Select boxes
    Route::get('/phones/getPhoneExtensions', 'App\Http\Controllers\calls\PhoneMasterController@getPhoneExtensions')->name('phones.getPhoneExtensions');
    Route::get('/phones/autocompleteName', 'App\Http\Controllers\calls\PhoneMasterController@autocompleteName')->name('phones.autocompleteName');
 
    Route::get('/populate', 'App\Http\Controllers\calls\PhoneMasterController@populate')->name('phones.populate');
    Route::get('/populateMovement', 'App\Http\Controllers\calls\PhoneMasterController@populateMovement')->name('phones.populateMovement');
    Route::get('/populateExtension', 'App\Http\Controllers\calls\PhoneMasterController@populateExtension')->name('phones.populateExtension');
    Route::get('report/range','App\Http\Controllers\calls\CallMatchingController@range')->name('report.range');
    Route::get('report/','App\Http\Controllers\calls\CallMatchingController@report')->name('report.report');
    Route::resource('/phones', 'App\Http\Controllers\calls\PhonesMovementController');
    Route::get('/editPhone', 'App\Http\Controllers\calls\PhonesMovementController@editPhone')->name('phones.editPhone');
    Route::get('/phones/getPhones', 'App\Http\Controllers\calls\PhonesMasterController@getPhones')->name('phones.getPhones');
    Route::get('/phones/phone/indexTable', 'App\Http\Controllers\calls\PhonesMovementController@indexTable')->name('phones.phone.indexTable');
    Route::resource('/saicom', 'App\Http\Controllers\calls\SaicomController');
    Route::resource('/calldata', 'App\Http\Controllers\calls\CallDataController');
    Route::resource('/callmatching', 'App\Http\Controllers\calls\CallMatchingController');
    Route::get('/calldata/create/midday', 'App\Http\Controllers\calls\CallDataController@createmidday')->name('calldata.create.midday');;
    Route::get('calldata/{date}', 'App\Http\Controllers\calls\PhonesMovementController@dayStats')->name('calldata.daystats');
    Route::post('import/calls', 'App\Http\Controllers\calls\CallDataController@import')->name('import.calls');
    Route::post('import/calls/midday', 'App\Http\Controllers\calls\CallDataController@importmidday')->name('import.calls.midday');
    Route::post('import/match', 'App\Http\Controllers\calls\CallDataController@match')->name('import.match');
    Route::get('/phones/list','App\Http\Controllers\calls\PhonesMasterController@getPhones')->name('phones.list');
    Route::get('phones/{job}', 'App\Http\Controllers\calls\PhonesMovementController@job')->name('phones.job');
});

Route::get('/import-calls-do', function() {
    (new CallImports())->importToDB();
    // dd('done');
    return back();
});

Route::get('/salesimport',[App\Http\Controllers\sales\SalesController::class, 'salesCost']);


// Route::resource('/users','UserController');

// Route::view('/docs','/docs')->name('docs');
// Route::get('/docs')->name('docs');


Auth::routes();

// Route::get('upload', function() {
//     return view('calls.upload-file');
// });

// Route::get('/upload', [CallsController::class, 'index']);
// Route::post('/uploads', [CallsController::class, 'store']);

 // Clear all cache with a single function
 Route::get('optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return back();
})->name('optimize-clear');

