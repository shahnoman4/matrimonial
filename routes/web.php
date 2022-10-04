<?php

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

use App\models\Page;

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
     return 'cleared';
});

if(Auth::check()==false){
//foreach ($pages as $key => $y) {
    Route::get('/{page_url_name?}', function ($page_url_name = null) {
        if (isset($page_url_name) && $page_url_name!='' && (!Auth::check())) {
            $page = Page::where('page_url_name',$page_url_name)->first();
            return view('front.page.index')->with('page',$page);
        }else if(!Auth::check())
        {
           
          return view('front.home.index');  
        }
       
    });
//}
}    

Route::group(['prefix'=> 'admin'],function(){

//Route::get('sendRegEmails', 'API\UserController@sendRegEmails');
Route::get('sendRegEmails', 'Admin\UserController@sendRegEmails');
Route::get('messageEmail', 'API\UserController@messageEmail')->name('messageEmail');


Auth::routes();
Route::get('/home', 'Admin\HomeController@index')->name('home');
//Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//Dashboard
Route::get('/dashboard', 'Admin\HomeController@dashboard')->middleware('auth')->name('dashboard');

Route::get('/changepassword', ['as' => 'changepassword' , function () {
    return view('admin/home/changepassword');
 }])->middleware('auth');

 Route::get('/profile', ['as' => 'profile' , function () {
    return view('admin/home/profile');
 }])->middleware('auth');

//Roles
 Route::get('/roles/deactivate/{id}', 'Admin\RoleController@deactivate')->middleware('auth');
 Route::get('/roles/active/{id}', 'Admin\RoleController@active')->middleware('auth');
 Route::resource('roles', 'Admin\RoleController')->middleware('auth');

//Staff/Admins
 Route::post('admins.delete', 'Admin\UserController@delete')->middleware('auth')->name('admins.delete');
 Route::group(['prefix'=> 'admins'],function(){
    Route::get('create', 'Admin\UserController@create')->middleware('can:create-staff')->name('admins.create');
    Route::post('', 'Admin\UserController@store')->middleware('can:create-staff')->name('admins.store');   
    Route::get('', 'Admin\UserController@index')->middleware('can:admins-index')->name('admins.index');
    Route::get('admins/fetch', 'Admin\UserController@fetch')->middleware('auth')->name('admins.fetch');
    Route::get('{id}', 'Admin\UserController@show')->middleware('can:show-staff')->name('admins.show');
    Route::delete('delete/{id}', 'Admin\UserController@destroy')->middleware('can:delete-staff')->name('admins.destroy');
    Route::get('{id}/edit', 'Admin\UserController@edit')->middleware('can:edit-staff')->name('admins.edit');
    Route::patch('{id}', 'Admin\UserController@update')->middleware('auth')->name('admins.update');
    //Staff Status
    Route::get('resetpassword/{id}', 'Admin\UserController@resetPassword')->middleware('can:staff-reset-password')->name('resetpassword');
    Route::get('deactivate/{id}', 'Admin\UserController@deactivate')->middleware('can:status-staff');
    Route::get('active/{id}', 'Admin\UserController@active')->middleware('can:status-staff');
    
 });

 //Admin Menu
 Route::get('/menu/deactivate/{id}', 'Admin\AdminmenuController@deactivate')->middleware('can:menu-index');
 Route::get('/menu/active/{id}', 'Admin\AdminmenuController@active')->middleware('can:menu-index');
 Route::resource('menu', 'Admin\AdminmenuController')->middleware('can:menu-index');


// Customers
Route::get('/customers', 'Admin\CustomerController@index')->middleware('can:customers-index')->name('customers.index');
Route::get('/customers/fetch', 'Admin\CustomerController@fetch')->middleware('can:customers-fetch')->name('customers.fetch');
Route::get('/customers/create','Admin\CustomerController@create')->middleware('can:customers-create')->name('customers.create');
Route::post('/customers/store', 'Admin\CustomerController@store')->middleware('can:customers-store')->name('customers.store');
Route::post('/customers/update', 'Admin\CustomerController@customerUpdate')->middleware('auth')->name('customers.update');
Route::get('/customers/edit/{id}', 'Admin\CustomerController@edit')->middleware('can:customers-edit')->name('customers.edit');
Route::get('/customers/show/{id}', 'Admin\CustomerController@show')->middleware('can:customers-show')->name('customers.show');
Route::post('customers/active','Admin\CustomerController@customerActive')->middleware('can:customers-active')->name('customers.active');
Route::post('customers/disable', 'Admin\CustomerController@customerDisable')->middleware('can:customers-disable')->name('customers.disable');

// country
Route::get('/country', 'Admin\CountryController@index')->middleware('can:country-index')->name('country.index');
Route::get('/country/fetch', 'Admin\CountryController@fetch')->middleware('can:country-fetch')->name('country.fetch');
Route::post('/country/store', 'Admin\CountryController@store')->middleware('can:country-store')->name('country.store');
Route::post('/country/edit', 'Admin\CountryController@edit')->middleware('can:country-edit')->name('country.edit');
Route::post('country/active', 'Admin\CountryController@countryActive')->middleware('can:country-active')->name('country.active');
Route::post('country/disable', 'Admin\CountryController@countryDisable')->middleware('can:country-disable')->name('country.disable');

// page
Route::get('/page', 'Admin\PageController@index')->middleware('can:page-index')->name('page.index');
Route::get('/page/fetch', 'Admin\PageController@fetch')->middleware('can:page-fetch')->name('page.fetch');
Route::get('/page/create', 'Admin\PageController@create')->middleware('can:page-create')->name('page.create');
Route::post('/page/store', 'Admin\PageController@store')->middleware('can:page-store')->name('page.store');
Route::post('/page/edit', 'Admin\PageController@edit')->middleware('can:page-edit')->name('page.edit');
Route::post('page/active', 'Admin\PageController@pageActive')->middleware('can:page-active')->name('page.active');
Route::post('page/disable', 'Admin\PageController@pageDisable')->middleware('can:page-disable')->name('page.disable');
 });