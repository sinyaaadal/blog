<?php

Route::get('/test', function(){
     return App\Post::find(5)->category;
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Signle URLs
Route::get('/', 'PageController@index')                                                 ->name('home');
Route::get('/post/{slug}', 'PageController@singlePage')                                 ->name('post.single');
Route::get('/category/{id}', 'PageController@categoryPage')                             ->name('category.single');
Route::get('/tag/{id}', 'PageController@tagPage')                                       ->name('tag.single');

// Search
Route::get('/search', function () {
    $posts = App\Post::where('title', 'like', '%' . request('search') . '%')->get();
    $categories = App\Category::take(5)->get();        
    $setting = App\Setting::first(); // Use first() because it has only one row instance
    $tags = App\Tag::all(); 
    $search = request('search');
    return view('search', compact('setting', 'categories', 'posts', 'tags', 'search'));
})->name('search');


// Auth middleware
Route::middleware('auth')->group(function (){

    // Home
    Route::get('/admin/home', 'HomeController@index')                                   ->name('home');

    // Post
    Route::get('/admin/post/', 'PostController@index')                                  ->name('post.index');
    Route::post('/admin/post/', 'PostController@store')                                 ->name('post.store');
    Route::get('/admin/post/create', 'PostController@create')                           ->name('post.create');
    Route::get('/admin/post/trash', 'PostController@trash')                             ->name('post.trash');        
    Route::patch('/admin/post/{id}/update', 'PostController@update')                    ->name('post.update');
    Route::delete('/admin/post/{id}/destroy', 'PostController@destroy')                 ->name('post.destroy'); 
    Route::get('/admin/post/{id}/edit', 'PostController@edit')                          ->name('post.edit');    
    Route::delete('/admin/post/{id}/empty-trash', 'PostController@emptyTrash')          ->name('post.empty.trash');
    Route::get('/admin/post/{id}/restore', 'PostController@restore')                    ->name('post.restore.trash');
    

    // Category
    Route::get('/admin/category/', 'CategoryController@index')                          ->name('category.index');
    Route::post('/admin/category/', 'CategoryController@store')                         ->name('category.store');
    Route::get('/admin/category/create', 'CategoryController@create')                   ->name('category.create');
    Route::get('/admin/category/{id}', 'CategoryController@show')                       ->name('category.show');
    Route::patch('/admin/category/{id}/update', 'CategoryController@update')            ->name('category.update');
    Route::delete('/admin/category/{id}/destroy', 'CategoryController@destroy')         ->name('category.destroy');
    Route::get('/admin/category/{id}/edit', 'CategoryController@edit')                  ->name('category.edit');

    // Tag
    Route::get('/admin/tag/', 'TagController@index')                                    ->name('tag.index');
    Route::post('/admin/tag/', 'TagController@store')                                   ->name('tag.store');
    Route::get('/admin/tag/create', 'TagController@create')                             ->name('tag.create');
    Route::get('/admin/tag/{id}', 'TagController@show')                                 ->name('tag.show');
    Route::patch('/admin/tag/{id}/update', 'TagController@update')                      ->name('tag.update');
    Route::delete('/admin/tag/{id}/destroy', 'TagController@destroy')                   ->name('tag.destroy');
    Route::get('/admin/tag/{id}/edit', 'TagController@edit')                            ->name('tag.edit');

    // User
    Route::get('/admin/user/', 'UserController@index')                                  ->name('user.index');
    Route::post('/admin/user/', 'UserController@store')                                 ->name('user.store');
    Route::get('/admin/user/create', 'UserController@create')                           ->name('user.create');
    Route::get('/admin/user/{id}', 'UserController@show')                               ->name('user.show');
    Route::patch('/admin/user/{id}/update', 'UserController@update')                    ->name('user.update');
    Route::delete('/admin/user/{id}/destroy', 'UserController@destroy')                 ->name('user.destroy');
    Route::get('/admin/user/{id}/edit', 'UserController@edit')                          ->name('user.edit');
    Route::get('/admin/user/{id}/make-admin', 'UserController@makeAdmin')               ->name('user.make.admin');
    Route::get('/admin/user/{id}/revoke-admin', 'UserController@revokeAdmin')           ->name('user.revoke.admin');    

    // Profile
    Route::get('/admin/profile', 'ProfileController@index')                             ->name('profile'); 
    Route::post('/admin/profile/update', 'ProfileController@update')                    ->name('profile.update');  
    
    // Settings
    Route::get('/admin/settings', 'SettingController@index')                            ->name('settings')                    ->middleware('admin');
    Route::post('/admin/settings/update', 'SettingController@update')                   ->name('settings.update')             ->middleware('admin');
});