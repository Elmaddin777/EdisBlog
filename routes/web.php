<?php
/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('isAdmin')->group(function(){
  Route::get('/panel', 'Back\DashboardController@dashboard')->name('dashboard');
  Route::get('/logout', 'Back\AuthController@logout')->name('logout');
  /*---------------------------ARTICLE ROUTES-----------------------------------*/
  Route::resource('/articles', 'Back\ArticlesController');
  Route::get('/switch', 'Back\ArticlesController@switch')->name('switch');
  Route::get('/trash', 'Back\ArticlesController@trashed')->name('trashed');
  Route::get('/trash/restore/{id}', 'Back\ArticlesController@restoreTrashedArticle')->name('trash.restore');
  Route::get('/trash/delete/{id}', 'Back\ArticlesController@deleteTrashedArticle')->name('trash.delete');
  /*---------------------------CATEGORY ROUTES----------------------------------*/
  Route::resource('/categories', 'Back\CategoryController');
  Route::get('/category/switch', 'Back\CategoryController@switch')->name('category.switch');
  Route::get('/category/get/data', 'Back\CategoryController@getCategoryData')->name('category.get.data');
  Route::post('/category/update', 'Back\CategoryController@updateCategory')->name('category.update');
  Route::post('/category/remove/', 'Back\CategoryController@deleteCategory')->name('category.delete.cat');
  /*---------------------------Config ROUTES----------------------------------*/
  Route::get('/website-configuration', 'Back\ConfigController@index')->name('config.index');
  Route::post('/website-configuration/update', 'Back\ConfigController@update')->name('config.update');

});

/*---------------------------LOGIN ROUTES----------------------------------*/
Route::prefix('admin')->middleware('isLoggedIn')->group(function(){
  Route::get('/login', 'Back\AuthController@login')->name('login');
  Route::post('/login', 'Back\AuthController@loginPost')->name('loginPost');
});



/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'Front\HomeController@homepage')->name('homepage');

Route::get('/blogs/{category}/{slug}', 'Front\HomeController@single')->name('single');

Route::get('/categories/{category}', 'Front\HomeController@category')->name('category');

Route::get('/contact', 'Front\HomeController@contact')->name('contact');

Route::post('/contact', 'Front\HomeController@contactStore')->name('contactPost');

Route::get('/{page}', 'Front\HomeController@page')->name('page');





