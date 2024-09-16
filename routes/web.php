<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserAccessoryController;
use App\Http\Controllers\UserAssetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::resource('employees', EmployeeController::class);
Route::resource('assets', AssetController::class);
Route::resource('accessories', AccessoryController::class);
Route::resource('userAssets', UserAssetController::class);
Route::resource('userAccessories', UserAccessoryController::class);

Route::get('/master/employee', 'EmployeeController@index')->name('employee.index');
Route::get('/employee/{nik}/edit', 'EmployeeController@edit')->name('employee.edit');
Route::get('/master/addemployee', function () {
    return view('master.addemployee');
})->name('addemployee');



Route::get('/master/asset', 'AssetController@index')->name('asset.index');
Route::get('/asset/{idAsset}/edit', 'AssetController@edit')->name('asset.edit');
Route::get('/master/addasset', function () {
    return view('master.addasset');
})->name('addasset');
Route::get('diagram/diagramAsset', 'AssetController@barChart')->name('diagramAsset');


Route::get('/master/accessory', 'AccessoryController@index')->name('accessory.index');
Route::get('/accessory/{idAcc}/edit', 'AccessoryController@edit')->name('accessory.edit');
Route::get('/master/addaccessory', function () {
    return view('master.addaccessory');
})->name('addasset');
Route::get('diagram/diagramAccessory', 'AccessoryController@barChart')->name('diagramAccessory');


Route::get('/userAsset/userAsset', 'UserAssetController@index')->name('userAsset.index');
Route::get('/userAsset/create', [UserAssetController::class, 'create'])->name('userAsset.create');
Route::post('/userAsset/{idAsset}/destroy', [UserAssetController::class, 'destroy'])->name('userAsset.destroy');
Route::get('userAsset/userAssetHistory', 'UserAssetController@userAssetHistory')->name('userAssetHistory');

Route::get('/userAccessory/userAccessory', 'UserAccessoryController@index')->name('userAccessory.index');
// Route::get('/accessory/{nik}/edit', 'AccessoryController@edit')->name('accessory.edit');
// Route::get('/userAccessory/{nik}/detail', 'userAccessoryController@detail')->name('userAccessory.detail');
Route::get('userAccessory/create', 'UserAccessoryController@create')->name('userAccessory.create');
Route::post('userAccessory/destroy/{modelNumber}', 'UserAccessoryController@destroy')->name('userAccessory.destroy');


// Route::post('/userAccessory/destroy/{nik}', 'userAccessoryController@destroy')->name('userAccessory.destroy');

// Route::get('/userAccessory/{nik}/add', function () {
//     return view('userAccessory/addUserAccessory');
// })->name('addUserAccessory');
// Route::get('/userAccessory/{nik}/detail', function () {
//     return view('userAccessory/detailUserAccessory');
// })->name('detailUserAccessory');

// Route::post('/userAccessory/{idAccessory}/destroy', [userAccessoryController::class, 'destroy'])->name('userAccessory.destroy');
// Route::get('/userAccessory/userAccessory', function () {
//     return view('userAccessory/addUserAccessory');
// })->name('addUserAccessory');

// Route::get('/userAsset/addUserAsset', function () {
//      return view('userAsset/addUserAsset');
// })->name('addUserAsset');