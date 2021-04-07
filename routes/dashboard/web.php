<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('welcome');
            Route::get('/chart/bar', 'WelcomeController@bar')->name('chart.bar');
            Route::get('/chart/line', 'WelcomeController@line')->name('chart.line');

            //category routes
            Route::resource('categories', 'CategoryController')->except(['show']);
            Route::get('categories/deleted', 'CategoryController@deleted')->name('categories.deleted'); // To View The clients Block
            Route::get('categories/restore/{id}', 'CategoryController@restore')->name('categories.restore');

            //product routes
            Route::resource('products', 'ProductController')->except(['show', 'restore']);
            Route::get('products/ended', 'ProductController@EndProducts')->name('products.EndProducts');
            Route::get('products/deleted', 'ProductController@deleted')->name('products.deleted');
            Route::get('products/restore/{id}', 'ProductController@restore')->name('products.restore');

            //client routes
            Route::resource('clients', 'ClientController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrderController')->except(['show']);
            // Make Block To Client
            Route::get('clients/deleted', 'ClientController@deleted')->name('clients.deleted'); // To View The clients Block
            Route::get('clients/restore/{id}', 'ClientController@restore')->name('clients.restore'); // To Unblock The clients

            //order routes
            Route::resource('orders', 'OrderController')->except(['show']);
            Route::get('orders/deleted', 'OrderController@deleted')->name('orders.deleted');
            Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');
            Route::get('orders/restore/{id}', 'OrderController@restore')->name('orders.restore');


            //user routes
            Route::resource('users', 'UserController')->except(['show']);
            Route::get('users/deleted', 'UserController@deleted')->name('users.deleted'); // To View The Users Block
            Route::get('users/restore/{id}', 'UserController@restore')->name('users.restore'); // To Unblock The Users

            //user => profile routes
            Route::get('profile', 'ProfileController@index')->name('profile');
            Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::post('profile/update', 'ProfileController@update')->name('profile.update');

            //Annual Reports routes
            Route::get('reports', 'ReportController@index')->name('reports');
            Route::get('reports/month', 'ReportController@show')->name('reports.month');
            Route::get('reports/month/{month}', 'ReportController@showDay')->name('reports.day');

            //Banners routes
            Route::resource('banners', 'BannerController');
            // To Unblock The Banners

        });//end of dashboard routes
    });


    Route::get('/home', function () {
        return redirect()->route('home');
    })->name('index');

